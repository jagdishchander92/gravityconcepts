<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{

    public function index()
    {

        $data['testimonials'] = Testimonial::all();
        return view('backend.seo.testimonials.testimonial_index', $data);
    }

    public function create()
    {
        $data['testimonial'] = new Testimonial();
        return view('backend.seo.testimonials.testimonial_create_edit', $data);
    }

    public function edit(Testimonial $testimonial)
    {
        $data['testimonial'] = $testimonial;
        return view('backend.seo.testimonials.testimonial_create_edit', $data);
    }

    public function storeUpdate(Request $request, Testimonial $testimonial = null)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'img' => $testimonial ? 'nullable|image' : 'required|image',
            'rating' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'rating' => $request->rating,
            'description' => $request->description,
            'status' => $request->status ?? 0
        ];

        if ($request->hasFile('img')) {
            if ($testimonial && $testimonial->img) {
                Storage::delete($testimonial->img);
            }
            $data['img'] = $request->file('img')->store('testimonials');
        }

        if ($testimonial) {
            $testimonial->update($data);
            return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated successfully');
        } else {
            Testimonial::create($data);
            return redirect()->route('admin.testimonials')->with('success', 'Testimonial Create successfully');
        }
    }

    public function delete($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial Deleted successfully');
    }
}
