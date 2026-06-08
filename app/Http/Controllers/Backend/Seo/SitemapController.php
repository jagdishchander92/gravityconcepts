<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SitemapController extends Controller
{



    public function generateSitemap()
    {
        $urls = [];

        // Home
        $urls[] = [
            'loc' => url('/'),
            'lastmod' => now()->toAtomString(),
        ];

        // Blogs Listing
        $urls[] = [
            'loc' => url('/blogs'),
            'lastmod' => now()->toAtomString(),
        ];

        // Pages
        $pages = Page::where('status', 1)
            ->select('slug', 'updated_at')
            ->get();

        foreach ($pages as $page) {

            $urls[] = [
                'loc' => url($page->slug),
                'lastmod' => $page->updated_at->toAtomString(),
            ];
        }

        // Blog Categories
        $blog_categories = Category::where('status', 1)
            ->select('slug', 'updated_at')
            ->get();

        foreach ($blog_categories as $category) {

            $urls[] = [
                'loc' => url('category/' . $category->slug),
                'lastmod' => $category->updated_at->toAtomString(),
            ];
        }

        // Blogs
        $blogs = Blog::where('status', 1)
            ->select('slug', 'updated_at')
            ->get();

        foreach ($blogs as $blog) {

            $urls[] = [
                'loc' => url('blog/' . $blog->slug),
                'lastmod' => $blog->updated_at->toAtomString(),
            ];
        }

        // XML Content
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {

            $xml .= '<url>';

            $xml .= '<loc>' . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . '</loc>';

            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';

            $xml .= '<changefreq>weekly</changefreq>';

            $xml .= '<priority>0.8</priority>';

            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        // Save sitemap.xml in public folder
        File::put(public_path('sitemap.xml'), $xml);

        return redirect()->back()->with('success', 'Sitemap Generated Successfully');
    }
}
