<?php

namespace App\Events\Vouchers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VouchersCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $successfulVouchers;
    public array $failedVouchers;
    public User $user;

    /**
     * @param Voucher[] $vouchers
     * @param User $user
     */
    public function __construct(
        array $successfulVouchers,
        array $failedVouchers,
        User $user
    ) {
        $this->successfulVouchers = $successfulVouchers;
        $this->failedVouchers = $failedVouchers;
        $this->user = $user;
    }
}
