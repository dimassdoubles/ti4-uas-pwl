<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, $validator->getMessageBag()->getMessages(), null);
        }

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'total' => $request->total,
        ]);

        return new ApiResource(true, 'Data transaction berhasil disimpan', $transaction);
    }

    public function show(Transaction $transaction)
    {
        return new ApiResource(true, 'Transaction berhasil diambil.', $transaction);
    }

    public function showDetailTransaction(Transaction $transaction)
    {
        $detail_transactions = $transaction->detailTransactions()->get();
        return new ApiResource(true, 'Detail transaction berhasil diambil.', $detail_transactions);
        // return $transaction->detailTransactions();
    }
}
