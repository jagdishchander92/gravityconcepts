<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $data['blogs_listing'] = Seo::where('key', 'blogs_listing')->first()?->data;
        $data['contact_us'] = Seo::where('key', 'contact_us')->first()?->data;
        $data['google_analytics'] = Seo::where('key', 'google_analytics')->first()?->data;
        return view('backend.seo.seo-index', $data);
    }

    public function blogsSeo(Request $request)
    {
        $data = [
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ];

        $seo = Seo::where('key', 'blogs_listing')->first();
        if ($seo) {
            $seo->update(['data' => $data]);
        } else {
            Seo::create([
                'key' => 'blogs_listing',
                'data' => $data
            ]);
        }
        return redirect()->route('seo.index')->with('success', 'Saved Successfully');
    }
    public function contactSeo(Request $request)
    {
        $data = [
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ];

        $seo = Seo::where('key', 'contact_us')->first();
        if ($seo) {
            $seo->update(['data' => $data]);
        } else {
            Seo::create([
                'key' => 'contact_us',
                'data' => $data
            ]);
        }
        return redirect()->route('seo.index')->with('success', 'Saved Successfully');
    }
    public function contactAnalytics(Request $request)
    {
        $data = [
            'header_codes' => $request->header_codes,
            'footer_codes' => $request->footer_codes,
        ];

        $seo = Seo::where('key', 'google_analytics')->first();
        if ($seo) {
            $seo->update(['data' => $data]);
        } else {
            Seo::create([
                'key' => 'google_analytics',
                'data' => $data
            ]);
        }
        return redirect()->route('seo.index')->with('success', 'Saved Successfully');
    }
}
