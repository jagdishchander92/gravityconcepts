<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PagecraftController extends Controller
{

    public function preview(Request $request, $slug)
    {
        if ($request->json) {
            $page = Page::where('slug', $slug)->firstOrFail();
            $breadcrumb = $page->header_section;
            $sections = $page->blocks;
            $sections = json_decode($request->json, true);
            return view('pagecraft.preview_2', compact('sections', 'breadcrumb'));
        } else {
            abort(404);
        }
    }
}
