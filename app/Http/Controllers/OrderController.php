<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Order $order)
{
    $this->authorize('view', $order); // optional if you're using policies

    return view('orders.show', compact('order'));
}

}
