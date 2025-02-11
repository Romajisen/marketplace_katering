<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function show()
    {
        $merchant = auth()->user()->merchant;

        return response()->json($merchant);
    }

    public function update(Request $request)
    {
        $merchant = auth()->user()->merchant;

        $request->validate([
            'company_name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'description' => 'nullable',
        ]);

        $merchant->update($request->all());

        return response()->json($merchant);
    }
}
