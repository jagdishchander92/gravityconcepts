<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CardsController extends Controller
{
    public function index()
    {
        $cards = Card::latest()->paginate(20);

        return view('backend.pages.cards.index', compact('cards'));
    }

    public function create()
    {
        $card = null;

        return view('backend.pages.cards.create-edit', compact('card'));
    }

    public function edit(Card $card)
    {
        return view('backend.pages.cards.create-edit', compact('card'));
    }

    public function storeUpdate(Request $request, $id = null)
    {
        $request->validate([
            'card_title' => 'required|string|max:255',
            'sub_title'  => 'nullable|string|max:255',
            'card_type'  => 'required|string|max:255',
            'btn_title'  => 'nullable|string|max:255',
            'btn_url'    => 'nullable|string|max:255',
            'card_img'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'card_icon'  => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
        ]);

        $card = $id ? Card::findOrFail($id) : new Card();

        $card->title      = $request->card_title;
        $card->sub_title  = $request->sub_title;
        $card->card_type  = $request->card_type;
        $card->btn_title  = $request->btn_title;
        $card->btn_url    = $request->btn_url;

        // Card Image
        if ($request->hasFile('card_img')) {

            // Delete old image
            if ($card->card_img && Storage::disk('public')->exists($card->card_img)) {
                Storage::disk('public')->delete($card->card_img);
            }

            // Store new image
            $card->card_img = $request->file('card_img')
                ->store('cards', 'public');
        }

        // Card Icon
        if ($request->hasFile('card_icon')) {

            // Delete old icon
            if ($card->card_icon && Storage::disk('public')->exists($card->card_icon)) {
                Storage::disk('public')->delete($card->card_icon);
            }

            // Store new icon
            $card->card_icon = $request->file('card_icon')
                ->store('cards', 'public');
        }

        $card->save();

        return redirect()
            ->route('cards.index')
            ->with('success', $id ? 'Card updated successfully' : 'Card created successfully');
    }

    public function delete($id)
    {
        $card = Card::findOrFail($id);

        // Delete image
        if ($card->card_img && Storage::disk('public')->exists($card->card_img)) {
            Storage::disk('public')->delete($card->card_img);
        }

        // Delete icon
        if ($card->card_icon && Storage::disk('public')->exists($card->card_icon)) {
            Storage::disk('public')->delete($card->card_icon);
        }

        $card->delete();

        return redirect()
            ->route('cards.index')
            ->with('success', 'Card deleted successfully');
    }
}
