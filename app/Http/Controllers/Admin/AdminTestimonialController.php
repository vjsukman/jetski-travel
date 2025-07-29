<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonial'));
    }

    public function create()
    {
        return view ('admin.testimonial.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $finalName = 'testimonial_'.time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/testimonial'), $finalName);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->photo = $finalName;
        $testimonial->save();

        return redirect()->route('admin_testimonial_index')->with('success', 'Testimonial created successfully.');

    }

    public function edit($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function edit_submit(Request $request, $id)
    {
        $testimonial = Testimonial::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            
            $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            unlink(public_path('uploads/testimonial/' . $testimonial->photo));

            $finalName = 'testimonial_'.time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/testimonial'), $finalName);
            $testimonial->photo = $finalName;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->photo = $finalName;
        $testimonial->save();

        return redirect()->route('admin_testimonial_index')->with('success', 'Testimonial updated successfully.');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        unlink(public_path('uploads/testimonial/' . $testimonial->photo));
        $testimonial->delete();
        return redirect()->route('admin_testimonial_index')->with('success', 'Testimonial deleted successfully.');
    }
}
