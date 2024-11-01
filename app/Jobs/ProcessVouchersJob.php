<?php

namespace App\Jobs;

use App\Events\Vouchers\VouchersCreated;
use App\Models\User;
use App\Services\VoucherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVouchersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $xmlContents;
    protected User $user;

    public function __construct(array $xmlContents, User $user)
    {
        $this->xmlContents = $xmlContents;
        $this->user = $user;
    }

    public function handle(VoucherService $voucherService)
    {
        $successfulVouchers = [];
        $failedVouchers = [];

        foreach ($this->xmlContents as $xmlContent) {
            try {
                $successfulVouchers[] = $voucherService->storeVoucherFromXmlContent($xmlContent, $this->user);
            } catch (\Exception $e) {
                $failedVouchers[] = ['xmlContent' => $xmlContent, 'reason' => $e->getMessage()];
            }
        }

        VouchersCreated::dispatch($successfulVouchers, $failedVouchers, $this->user);
    }
}
