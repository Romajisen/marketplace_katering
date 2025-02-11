<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::whereHas('order', function($query) {
            $query->where('user_id', auth()->id());
        })->with('order')->get();

        return response()->json($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::with('order')
            ->where('id', $id)
            ->whereHas('order', function($query) {
                $query->where('user_id', auth()->id());
            })->firstOrFail();

        return response()->json($invoice);
    }
}
