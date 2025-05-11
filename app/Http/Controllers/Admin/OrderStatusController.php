<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    /**
     * Show the order status view with logs.
     */
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        $logs = OrderStatusLog::where('order_id', $orderId)->orderBy('created_at', 'desc')->get();
    
        // Admin view
        if (Auth::user()->role === 1) {
            return view('admin.orders.status', compact('order', 'logs'));
        }
    
        // Ensure the client owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        // Client view
        return view('profile.orders.status', compact('order', 'logs'));
    }

    /**
     * Update the order status and log the change.
     */
    public function update(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $order = Order::findOrFail($orderId);

        // Log the status change
        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        // Update order status
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.status', $order->id)->with('success', 'Order status updated.');
    }
}
