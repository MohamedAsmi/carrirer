<?php

namespace App\Http\Service;

use App\Models\CustomerAddress;
use Exception;
use Illuminate\Support\Facades\Log;

class CustomerAddressService
{
    public function __construct()
    {
    }

    public function createAddress($address = array())
    {
        try {
            $address = CustomerAddress::create($address);
            return $address->id;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
