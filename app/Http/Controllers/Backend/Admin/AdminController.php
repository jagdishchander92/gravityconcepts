<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\CustomCode;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function contactFormIndex(Request $request)
    {
        if ($request->q) {
            $query = "%" . $request->q . "%";
            $contacts = Contact::orderBy('id', 'desc')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', $query)
                        ->orWhere('email', 'like', $query)
                        ->orWhere('phone', 'like', $query)
                        ->orWhere('subject', 'like', $query)
                        ->orWhere('message', 'like', $query);
                })
                ->paginate(25);
        } else {
            $contacts = Contact::orderBy('id', 'desc')->paginate(25);
        }

        return view('backend.admin.contact-list', compact('contacts'));
    }

    public function customCodes()
    {
        $data['custom_codes'] = CustomCode::paginate(25);
        return view('backend.admin.custom-codes.custom_code_index', $data);
    }

    public function customCodeCreate()
    {
        return view('backend.admin.custom-codes.custom_code_create');
    }
    public function customCodeEdit($id)
    {
        $customCode = CustomCode::findOrFail($id);
        return view('backend.admin.custom-codes.custom_code_create',compact('customCode'));
    }
    public function customCodeStoreUpdate(Request $request, $id = null)
    {
        $request->validate([
            'type'  => 'required|in:header,footer',
            'codes' => 'required',
        ]);

        CustomCode::updateOrCreate(
            ['id' => $id],
            [
                'type'  => $request->type,
                'codes' => $request->codes,
            ]
        );

        return redirect()->route('admin.custom_codes.index')->with('success', 'Custom code saved successfully.');
    }
}
