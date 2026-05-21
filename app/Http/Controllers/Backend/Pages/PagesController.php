<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $data['pages'] = Page::orderBy('id', 'DESC')->paginate(15);

        return view('backend.pages.pages-index', $data);
    }
    public function create()
    {
        $data['page'] = null;
        return view('backend.pages.page-builder-step-1', $data);
    }
    public function storeUpdate(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $page_header = [
            'image' => $request->breadcrumb_image,
            'breadcrumb_title' => $request->breadcrumb_title,
            'breadcrumb_subtitle' => $request->breadcrumb_subtitle,
            'section_title' => $request->section_title,
            'section_description' => $request->section_description,
        ];

        $data_table = [
            'title' => $request->title,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_desc,
            'header_section' => $page_header,
        ];
       
        $page = Page::updateOrCreate(['id' => $id], $data_table);

        return response()->json([
            'status' => true,
            'page_id' => $page->id,
            'message' => 'Page Created Successfully'
        ]);

    }
    public function edit($id)
    {
        $data['page'] = Page::find($id);
        return view('backend.pages.page-builder-step-1', $data);
    }
    public function delete($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page Deleted Successfully');
    }

    public function preview(Request $request)
    {
        // Build a fake $page object just like your show/frontend view expects
        $page = new Page();
        $page->title          = $request->title;
        $page->slug           = $request->slug;
        $page->meta_title     = $request->meta_title;
        $page->meta_description = $request->meta_desc;
        $page->blocks         = $request->sections ?? [];
        $page->header_section = [
            'breadcrumb_title'    => $request->breadcrumb_title,
            'breadcrumb_subtitle' => $request->breadcrumb_subtitle,
            'section_title'       => $request->section_title,
            'section_description' => $request->section_description,
            'image'               => $request->breadcrumb_image,
        ];
        $data['blocks'] = $page->blocks;
        $data['head'] = $page->header_section;

        // Render your existing frontend page view
        return view('frontend.page.page_view', $data);
    }

    public function changeStatus(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->status;
        $page->save();

        return response()->json([
            'success' => true,
            'status' => $page->status
        ]);
    }

    public function clone($id)
    {
        $page = Page::findOrFail($id);
        $blocks = $page->blocks;
        $newBlocks = [];

        foreach ($blocks as $key => $block) {
            $newBlocks[$key] = [
                'type' => $block['type'] ?? null,
                'section_style' => $block['section_style'] ?? null,
                'section_title' => null,
                'section_subtitle' => null,
                'section_description' => null,
                'items' => [],
            ];
        }
        $newPage = $page->replicate();
        $newPage->slug = null;
        $newPage->blocks = $newBlocks;
        $newPage->header_section = null;
        $newPage->meta_title = null;
        $newPage->meta_description = null;
        $newPage->title = $newPage->title . " Copy";
        $newPage->save();

        return redirect()->route('pages.index')->with('success', 'Page Cloned Successfully');
    }
}
