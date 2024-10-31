<?php

namespace App\Http\Controllers\Vouchers\Voucher;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeleteVoucherHandler
{
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $voucher->delete();

        return response()->json([
            'message' => 'Voucher deleted successfully',
            'voucher' => $voucher
        ], 200);
    }
}
