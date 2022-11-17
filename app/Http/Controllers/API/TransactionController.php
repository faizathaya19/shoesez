<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $status = $request->input('status');
        // parameter

        if($id)
        {
            $transaction = Transaction::with(['item.product'])->find($id);
            // parameter transaction dengan model Transaction yg memanggil item dan product menggunakan find dan pemanggilan id nya

            if($transaction)
            {
                return ResponseFormatter::success(
                    $transaction,
                    'Data Transaksi berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data Transaksi tidak ada',
                    404
                );
            }
        }

        $transaction = Transaction::with(['item.product'])->where('users_id', Auth::user()->id);
            // parameter transaction dengan model Transaction yg memanggil item dan product menggunakan where dan pemanggilanid dari user_id nya karna ingin menampilkan semua data


        if($status)
        {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaction berhasil diambil'
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' =>'exists:products,id',
            // array untuk mengecek items mengunakan wildcard(*) untuk mengecek seluruh items ada atau tidak berdasarkan id menggunakan validasi exists untuk products menggunakan id
            'total_price' => 'required',
            'shipping_price' => 'required',
            'status' => 'required|in:PENDING,SUCCESS,CANCELLED,FAILED,SHIPPING,SHIPPED'
            // membuat status menggunakan validasi "in" dan yg akan muncul hanya yg di daftarkan
        ]);

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'shipping_price' => $request->shipping_price,
            'status' => $request->status,
        ]);
            // parameter transaction ARRAY dengan model Transaction 

        foreach($request->items as $product) {
            TransactionItem::create([
                'users_id' => Auth::user()->id,
                'products_id' => $product['id'],
                'transactions_id' => $transaction->id,
                'quantity' => $product['quantity']
            ]);
        }

        return ResponseFormatter::success($transaction->load('items.product'), 'Transaksi Berhasil');
    }
}
