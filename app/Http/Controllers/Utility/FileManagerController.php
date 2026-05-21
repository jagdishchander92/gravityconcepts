<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Services\ImageServices;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    // public function index(Request $request)
    // {
    //     $files = collect(Storage::files('/tinymce'))
    //         ->map(function ($file) {
    //             return [
    //                 'url' => asset('storage/tinymce/' . basename($file)),
    //                 'name' => basename($file)
    //             ];
    //         })
    //         ->values();

    //     $perPage = 12;
    //     $page = $request->page ?? 1;

    //     $paginated = $files->forPage($page, $perPage)->values();

    //     return response()->json([
    //         'data' => $paginated,
    //         'next_page' => count($paginated) == $perPage ? $page + 1 : null
    //     ]);
    // }
    public function index(Request $request)
    {
        $files = collect(Storage::disk('public')->allFiles())
            ->filter(function ($file) {

                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $filename = pathinfo($file, PATHINFO_FILENAME);

                // Only allow image types
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                    return false;
                }

                // Exclude resized images (e.g. -150x150)
                if (preg_match('/-\d+x\d+$/', $filename)) {
                    return false;
                }

                return true;
            })
            ->sortByDesc(function ($file) {
                return Storage::disk('public')->lastModified($file);
            })
            ->map(function ($file) {
                return [
                    'url' => Storage::disk('public')->url($file),
                    'name' => basename($file),
                    'path' => $file
                ];
            })
            ->values();

        $perPage = 12;
        $page = $request->page ?? 1;

        $paginated = $files->forPage($page, $perPage)->values();

        return response()->json([
            'data' => $paginated,
            'next_page' => count($paginated) == $perPage ? $page + 1 : null
        ]);
    }

    public function upload(Request $request)
    {
        // $file = $request->file('file');
        // $name = time() . '_' . $file->getClientOriginalName();

        // $file->storeAs('public/tinymce', $name);
        $imageService = new ImageServices();
        $result = $imageService->storeImage($request->file('file'));

        return response()->json([
            'location' => asset($result['original'])
        ]);
    }

    public function delete($name)
    {
        Storage::delete('public/tinymce/' . $name);
        return response()->json(['success' => true]);
    }
}
