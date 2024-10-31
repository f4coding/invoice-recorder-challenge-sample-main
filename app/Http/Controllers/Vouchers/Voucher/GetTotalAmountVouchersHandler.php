<?php

namespace App\Http\Controllers\Vouchers\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GetTotalAmountVouchersHandler extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::user();

        $totalSoles = Voucher::where('user_id', $user->id)
            ->where('currency', 'PEN')
            ->sum('total_amount');

        $totalDollars = Voucher::where('user_id', $user->id)
            ->where('currency', 'USD')
            ->sum('total_amount');

        return response()->json([
            'data' => [
                'total_soles' => $totalSoles,
                'total_dollars' => $totalDollars,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ],
        ], 200);
    }
}
