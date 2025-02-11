<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('merchant')->get();

        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/menu_photos');
        }

        $menu = Menu::create([
            'merchant_id' => auth()->user()->merchant->id,
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photoPath,
            'price' => $request->price,
        ]);

        return response()->json($menu, 201);
    }

    public function show($id)
    {
        $menu = Menu::with('merchant')->findOrFail($id);

        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        // Pastikan hanya merchant pemilik menu yang dapat mengupdate
        $this->authorize('update', $menu);

        $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/menu_photos');
            $menu->photo = $photoPath;
        }

        $menu->update($request->only(['name', 'description', 'price']));

        return response()->json($menu);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $this->authorize('delete', $menu);

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
