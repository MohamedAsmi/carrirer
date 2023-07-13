<?php

namespace App\Jobs;

use App\Http\Helper\Service\CustomerAddressService;
use App\Http\Helper\Service\OrderService;
use App\Models\JobTracking;
use App\Services\ShopifyService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncOrders implements ShouldQueue
{
    private $user;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        OrderService $orderService,
        CustomerAddressService $customerAddressService,
        ShopifyService $shopifyService
    ) {
        $jobTracking = $this->updateJobTracking('running');
        try {
            $shopifyService->syncOrder($this->user, $orderService, $customerAddressService);
            $this->updateJobTracking('completed');
        } catch (Exception $e) {
            if ($jobTracking !== null) {
                $this->updateJobTracking('failed');
            }
            Log::critical(['code' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => json_encode($e->getTrace())]);
            throw $e;
        }
    }

    private function updateJobTracking($status)
    {
        JobTracking::updateOrCreate(
            ['user_id' => $this->user->id, 'job_class' => self::class],
            ['status' => $status, 'user_id' => $this->user->id, 'job_class' => self::class]
        );
    }
}
