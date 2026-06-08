<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    public function index(Request $request)
    {

        $query = Blog::with(['category']);
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('slug', 'like', '%' . $request->q . '%');
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $data['blogs'] = $query->paginate(25);
        $data['categories'] = Category::all();
        return view('backend.seo.blog.blog-index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::select('title', 'id')->where('status', 1)->get();
        $data['blog'] = null; // important
        return view('backend.seo.blog.blog-create-edit', $data);
    }

    public function edit($id)
    {
        $data['categories'] = Category::select('title', 'id')->where('status', 1)->get();
        $data['blog'] = Blog::findOrFail($id);

        return view('backend.seo.blog.blog-create-edit', $data);
    }
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $blog = $id ? Blog::findOrFail($id) : new Blog();

        $baseUrl = url('/');

        $blog->title = $request->title;
        $blog->meta_title = $request->meta_title;
        $blog->slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title);

        $blog->summary = $request->summary;
        $blog->meta_desc = $request->meta_desc;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->tags = $request->tags;

        if ($request->schedule_post == 'on' && $request->published_at) {
            $blog->status = 2;
            $blog->published_at = $request->published_at;
        } elseif ($request->has('draft')) {
            $blog->status = 3;
        } else {
            $blog->status = 1;
            $blog->published_at = Carbon::now();
        }

        if ($request->img) {
            if (Str::startsWith($request->img, $baseUrl)) {
                $blog->img = $request->img;
            } else {
                $blog->img = $this->handleExternalImage($request->img);
            }
        }

        $blog->img_desc = $request->img_desc;

        $slider = $request->slider;

        if (is_string($slider)) {
            $slider = json_decode($slider, true);
        }

        $blog->slider = $slider;


        $blog->save();

        return redirect('backend/seo/blogs')->with('success', $id ? 'Blog Updated' : 'Blog Created');
    }
    private function handleExternalImage($url)
    {
        try {
            $response = Http::get($url);

            if (!$response->successful()) {
                throw new \Exception('Image download failed');
            }
            $tempPath = storage_path('app/temp_' . uniqid() . '.jpg');
            file_put_contents($tempPath, $response->body());
            $file = new \Illuminate\Http\File($tempPath);
            $imageService = app(\App\Services\ImageServices::class);
            $result = $imageService->storeImage($file);
            unlink($tempPath);
            return $result['original'];
        } catch (\Exception $e) {

            Log::error('External image failed: ' . $e->getMessage());
            return null;
        }
    }

    public function delete($id)
    {
        Blog::where('id', $id)->delete();
        return redirect('seo/blogs')->with('success', 'Blog Deleted Successfully');
    }

    public function commentIndex(Request $request)
    {
        if ($request->status !== null) {
            $data['comments'] = Comment::with(['blog'])->where('status', $request->status)->paginate(50);
        } else {
            $data['comments'] = Comment::with(['blog'])->paginate(50);
        }


        return view('backend.seo.blog.blog-comment-list', $data);
    }
    public function commentStatus(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'status' => 'required|in:0,1',
        ]);

        $comment = Comment::find($request->comment_id);

        $comment->status = $request->status;
        $comment->save();

        return response()->json([
            'status' => 1,
            'message' => $request->status == 1
                ? 'Comment Approved Successfully'
                : 'Comment Disapproved Successfully'
        ]);
    }


    public function changeBlogStatus(Request $request)
    {
        $blog =  Blog::where('id', $request->id)->first();
        if ($blog) {
            $blog->status = $request->status;
            if (!$blog->published_at && $request->status == 1) {
                $blog->published_at = Carbon::now();
            }
            $blog->save();
        }

        return response()->json(['success' => true, 'message' => "Status changed successfully"]);
    }
}
