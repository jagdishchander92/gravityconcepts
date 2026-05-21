<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
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
}
