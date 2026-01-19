<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Sesuaikan dengan nama Model pesanan kamu (misal: Transaction)

class OrderController extends Controller
{
    public function index()
    {
        // Ambil data pesanan milik user yang sedang login
        // Diurutkan dari yang terbaru
        // Ganti 'Order' dengan nama model kamu jika beda
        $orders = Order::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('user.orders', compact('orders'));
    }
}