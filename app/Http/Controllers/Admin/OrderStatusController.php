<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{

    public function index()
{
    // Ensure only admin can access
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    $orders = Order::latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}
    /**
     * Display the order status and its change history.
     */
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        $logs = OrderStatusLog::where('order_id', $orderId)
                              ->orderBy('created_at', 'desc')
                              ->get();

        // Admin view
        if (Auth::user()->role === 'admin') {
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
     * Update the order status and log the update.
     */
    public function update(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'note'   => 'nullable|string|max:500',
        ]);

        $order = Order::findOrFail($orderId);

        // Only admins can update
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Update status log
        OrderStatusLog::create([
            'order_id' => $order->id,
            'status'   => $request->status,
            'note'     => $request->note,
        ]);

        // Update order
        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.status.show', $order->id)
            ->with('success', 'Order status updated.');
    }
}
