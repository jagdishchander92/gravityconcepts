<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('backend.menus.index', compact('menus'));
    }

    public function create()
    {
        $menu = null;
        return view('backend.menus.edit', compact('menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        Menu::create([
            'name' => $request->name,
            'type' => $request->type,
            'menu' => json_decode($request->menu, true) // This will be sent as a JSON string from the UI
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu created!');
    }

    public function edit(Menu $menu)
    {
        return view('backend.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update([
            'name' => $request->name,
            'type' => $request->type,
            'menu' => json_decode($request->menu, true)
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu updated!');
    }
}
