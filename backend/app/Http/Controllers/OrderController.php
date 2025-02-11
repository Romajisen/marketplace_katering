<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Invoice;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['menu', 'menu.merchant'])
            ->where('user_id', auth()->id())
            ->get();

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after_or_equal:today',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $totalPrice = $menu->price * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Buat invoice
        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
            'amount' => $order->total_price,
            'invoice_date' => now(),
        ]);

        return response()->json([
            'order' => $order,
            'invoice' => $invoice,
        ], 201);
    }

    public function show($id)
    {
        $order = Order::with(['menu', 'menu.merchant', 'invoice'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json($order);
    }
}
