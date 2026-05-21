<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['blogs_count'] = Blog::count();
        $data['pages_count'] = Page::count();
        $data['comments_count'] = Comment::count();
        $data['testimonials_count'] = Testimonial::count();
        $data['latest_blogs'] = Blog::latest('id')->take(10)->get();
        $data['top_blogs'] = Blog::orderBy('page_views', 'desc')->take(10)->get();
        $data['latest_comments'] = Comment::latest('id')->take(10)->get();
        return view('backend.dashboard.index', $data);
    }
}
