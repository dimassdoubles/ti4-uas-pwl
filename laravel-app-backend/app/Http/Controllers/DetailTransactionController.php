<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailTransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|exists:transactions,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, $validator->getMessageBag()->getMessages(), null);
        }

        $detail_transaction = DetailTransaction::create([
            'transaction_id' => $request->transaction_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return new ApiResource(true, 'Detail transaction berhasil disimpan.', $detail_transaction);
    }

    public function show(DetailTransaction $detail_transaction)
    {
        return new ApiResource(true, 'Detail transactions berhasil diambil', $detail_transaction);
    }
}
