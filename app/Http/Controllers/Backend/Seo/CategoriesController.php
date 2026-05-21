<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('backend.seo.category.category-index', compact('categories'));
    }

    public  function ajaxCategories(Request $request)
    {
        $query = Category::query();

        // 🔍 search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $perPage = 10;

        $categories = $query->paginate($perPage);

        return response()->json([
            'data' => $categories->items(),
            'next_page' => $categories->currentPage() < $categories->lastPage()
                ? $categories->currentPage() + 1
                : null
        ]);
    }

    public function storeCategory(Request $request)
    {
        try {

            $data['parent_id'] = (isset($request->parent_id) && $request->parent_id !== '' && $request->parent_id !== 'null')
                ? (int) $request->parent_id
                : 0;
            $data['title'] = $request->title;
            $data['slug'] = Str::slug($request->title);
            $data['status'] = 1;
            // Image Upload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/category'), $name);
                $data['img'] = 'uploads/category/' . $name;
            }

            if ($request->id) {
                // Update
                $category = Category::findOrFail($request->id);

                // delete old image (optional)
                if ($request->hasFile('img') && $category->img && file_exists(public_path($category->img))) {
                    unlink(public_path($category->img));
                }

                $category->update($data);

                return response()->json(['status' => 1, 'message' => 'Category Updated Successfully']);
            } else {
                // Create
                Category::create($data);
                return response()->json(['status' => 1, 'message' => 'Category Created Successfully']);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }
    public function getCategory($id)
    {
        $category = Category::with('parent')->findOrFail($id);
        return response()->json($category);
    }
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);


            if ($category->img && file_exists(public_path($category->img))) {
                unlink(public_path($category->img));
            }


            if ($category->children()->count()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Cannot delete! Category has subcategories.'
                ]);
            }

            $category->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Category deleted successfully'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 0,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
