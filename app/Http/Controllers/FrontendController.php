<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Seo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    // public function page()

    // {
    //     return view('frontend.home_01');
    // }
    public function page($slug = '/')
    {
        if ($slug == '/') {
            $page = Page::where('slug', $slug)->first();
            if ($page) {
                $breadcrumb = $page->header_section;
                $sections = $page->blocks;
            } else if ($page?->status != 1) {
                $breadcrumb = null;
                $sections = null;
                abort(404);
            } else {
                $breadcrumb = null;
                $sections = null;
                abort(404);
            }
        } else {

            $page = Page::where('slug', $slug)->firstOrFail();
            $breadcrumb = $page->header_section;
            $sections = $page->blocks;
            if ($page->status != 1) {
                $breadcrumb = null;
                $sections = null;
                abort(404);
            }
        }

        return view('pagecraft.preview_2', compact('page', 'sections', 'breadcrumb'));
    }

    public function blogByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Blog::with(['category']);
        $query->where('category_id', $category->id);
        $website_common_info = Setting::where('key', 'website_common_info')->first();
        $website_common_info = $website_common_info ? json_decode($website_common_info->value, true) : [];
        $cat_tilte = $category->title ?? '';
        $website_name = $website_common_info['web_name'] ?? '';
        $data['title'] = $cat_tilte . ' - ' . $website_name;
        $data['meta_title'] = $category->meta_title ?? '';
        $data['meta_desc'] = $category->meta_desc ?? '';
        $data['blogs'] = $query->paginate(16);
        return view('frontend.blog-list', $data);
    }
    public function blogsList(Request $request)
    {
        $query = Blog::with(['category']);
        if ($request->has('category') && $request->category != null) {
            $query->where('category_id', $request->category);
        }
        if ($request->has('tags') && $request->tags != null) {
            $query->where('tags', 'like', '%' . $request->tags . '%');
        }
        $blogs_seo = Seo::where('key', 'blogs_listing')->first()?->data;
        $data['title'] = $blogs_seo['title'] ?? '';
        $data['meta_title'] = $blogs_seo['meta_title'] ?? '';
        $data['meta_desc'] = $blogs_seo['meta_desc'] ?? '';
        $data['blogs'] = $query->paginate(16);
        return view('frontend.blog-list', $data);
    }
    public function showBlog($slug)
    {
        $blog = Blog::with(['category', 'comments'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        $blog->increment('page_views');
        $data['categories'] = Category::all();
        $data['blog'] = $blog;
        $data['top_5_blogs'] = Blog::with(['category'])->orderBy('page_views', 'desc')->limit(5)->get();
        $data['related_blogs'] = Blog::with(['category'])
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(12)
            ->get();
        return view('frontend.blog-view', $data);
    }
    public function storeComment(Request $request)
    {
        $request->validate([
            'blog_id' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'message' => 'required|min:3',
        ]);

        Comment::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Comment saved successfully!'
        ]);
    }
    public function contactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json()['success']) {
            return response()->json([
                'errors' => ['captcha' => ['Captcha verification failed']]
            ], 422);
        }

        Contact::create($request->only([
            'name', 'email', 'phone', 'subject', 'message'
        ]));
        $website_info = \App\Models\Setting::where('key', 'website_common_info')->first();
        if ($website_info && $website_info->value) {
            $website_info = json_decode($website_info->value, true);
        }
        $admin_email = 'rakesh@vaticinfotech.com';
        $subject = 'New Contact Form submitted from ' . $website_info['web_name'] ?: '-';
        $body = view('emails.contact_form', ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'subject' => $request->subject, 'message' => $request->message])->render();
        send_email($admin_email, $subject, $body);
        return response()->json(['success' => true]);
    }
}
