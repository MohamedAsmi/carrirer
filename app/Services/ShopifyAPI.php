<?php

namespace App\Services;

use App\Models\Store;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ShopifyAPI
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;
    protected $apiSecret;
    protected $apiVersion;
    protected $accessToken;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = config('marketplace.shopify.client_id');
        $this->apiSecret = config('marketplace.shopify.client_secret');
        $this->apiVersion = config('marketplace.shopify.api_version');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getAuthorizationUrl($redirectUrl)
    {
        $authUrl = $this->baseUrl . '/admin/oauth/authorize';
        $params = [
            'client_id' => $this->apiKey,
            'redirect_uri' => $redirectUrl,
            'scope' => 'read_orders', // Add the required scopes
            'state' => csrf_token(), // Include CSRF token for security
        ];

        return $authUrl . '?' . http_build_query($params);
    }

    public function requestAccessToken($code)
    {
        $tokenUrl = $this->baseUrl . '/admin/oauth/access_token';

        $response = $this->client->post($tokenUrl, [
            'json' => [
                'client_id' => $this->apiKey,
                'client_secret' => $this->apiSecret,
                'code' => $code,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $this->accessToken = $data['access_token'];

        // Save the access token for future requests
        Cache::put('shopify_access_token', $this->accessToken, 60);

        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    protected function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-Shopify-Access-Token' => $this->accessToken,
        ];
    }

    public function getProducts()
    {
        $cacheKey = 'shopify_products';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = $this->client->get('/admin/api/2021-09/products.json', [
            'headers' => $this->getHeaders(),
        ]);

        $products = json_decode($response->getBody(), true)['products'];

        Cache::put($cacheKey, $products, 60); // Cache for 60 minutes

        return $products;
    }

    public function createProduct($data)
    {
        $response = $this->client->post('/admin/api/2021-09/products.json', [
            'headers' => $this->getHeaders(),
            'json' => [
                'product' => $data,
            ],
        ]);

        return json_decode($response->getBody(), true)['product'];
    }


    public function getOrders()
    {
        $cacheKey = 'shopify_products';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = $this->client->get($this->baseUrl . '/admin/api/' . $this->apiVersion . '/orders.json', [
            'headers' => $this->getHeaders(),
        ]);

        $orders = json_decode($response->getBody(), true)['orders'];

        Cache::put($cacheKey, $orders, 60); // Cache for 60 minutes

        return $orders;
    }
}
