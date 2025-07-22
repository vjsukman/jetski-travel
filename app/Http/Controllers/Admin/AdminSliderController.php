<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view ('admin.slider.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            'heading' => 'required',
            'text' => 'required',
            'button_text' => 'nullable',
            'button_link' => 'nullable'
        ]);

        $finalName = 'slider_'.time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/sliders'), $finalName);

        $sliders = new Slider();
        $sliders->photo = $finalName;
        $sliders->heading = $request->heading;
        $sliders->text = $request->text;
        $sliders->button_text = $request->button_text;
        $sliders->button_link = $request->button_link;
        $sliders->save();

        return redirect()->route('admin_slider_index')->with('success', 'Slider created successfully.');

    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.edit', compact('slider'));
    }

    public function edit_submit(Request $request, $id)
    {
        $slider = Slider::where('id', $id)->first();

        $request->validate([
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'heading' => 'required',
            'text' => 'required',
            'button_text' => 'nullable',
            'button_link' => 'nullable'
        ]);

        if ($request->hasFile('photo')) {
            
            $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            unlink(public_path('uploads/sliders/' . $slider->photo));

            $finalName = 'slider_'.time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/sliders'), $finalName);
            $slider->photo = $finalName;
        }

        $slider->heading = $request->heading;
        $slider->text = $request->text;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->save();

        return redirect()->route('admin_slider_index')->with('success', 'Slider updated successfully.');
    }

    public function delete($id)
    {
        $slider = Slider::where('id', $id)->first();
        unlink(public_path('uploads/sliders/' . $slider->photo));
        $slider->delete();
        return redirect()->route('admin_slider_index')->with('success', 'Slider deleted successfully.');
    }
}
