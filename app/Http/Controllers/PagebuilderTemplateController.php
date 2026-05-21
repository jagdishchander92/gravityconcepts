<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\PagebuilderTemplate;

class PagebuilderTemplateController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $template = PagebuilderTemplate::create([
            'name' => $request->name,
            'type' => $request->type ?? 'section',
            'preview' => $request->preview,
            'content' => $request->content
        ]);

        return response()->json([
            'status' => true,
            'template' => $template
        ]);
    }

    public function list()
    {
        $templates = PagebuilderTemplate::latest()->get();

        return response()->json([
            'status' => true,
            'templates' => $templates
        ]);
    }
    public function deleteTemplate(Request $request)
    {
        $template = PagebuilderTemplate::find($request->template_id);
        if ($template) {
            $template->delete();
        }

        return response()->json([
            'status' => true,
            'message' => "Deleted Successfully"
        ]);
    }

    public function storePage(Request $request)
    {
        $page_id = $request->page_id;
        $blocks = $request->sections;
        Page::where('id', $page_id)->update(['blocks' => $blocks]);
        return response()->json([
            'status' => true,
            'message' => "Saved Successfully"
        ]);
    }
}
