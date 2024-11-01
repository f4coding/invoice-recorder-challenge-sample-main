<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Requests\Vouchers\GetVouchersRequest;
use App\Http\Resources\Vouchers\VoucherResource; // Ensure this path is correct and the class exists
use App\Services\VoucherService;
use Illuminate\Http\Response;

class GetVouchersHandler
{
    public function __construct(private readonly VoucherService $voucherService)
    {
    }

    public function __invoke(GetVouchersRequest $request): Response
    {
        $vouchers = $this->voucherService->getVouchers(
            $request->query('page'),
            $request->query('paginate'),
            $request->query('series'),
            $request->query('number'),
            $request->query('start_date'),
            $request->query('end_date')
        );

        return response([
            'data' => VoucherResource::collection($vouchers),
        ], 200);
    }
}
