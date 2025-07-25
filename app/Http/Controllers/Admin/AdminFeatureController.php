<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    public function index()
    {
        $feature = Feature::all();
        return view('admin.feature.index', compact('feature'));
    }

    public function create()
    {
        return view ('admin.feature.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        $feature = new Feature();
        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->description = $request->description;
        $feature->save();

        return redirect()->route('admin_feature_index')->with('success', 'feature created successfully.');

    }

    public function edit($id)
    {
        $feature = Feature::where('id', $id)->first();
        return view('admin.feature.edit', compact('feature'));
    }

    public function edit_submit(Request $request, $id)
    {
        $feature = Feature::where('id', $id)->first();

        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->description = $request->description;
        $feature->save();

        return redirect()->route('admin_feature_index')->with('success', 'Feature updated successfully.');
    }

    public function delete($id)
    {
        $feature = Feature::where('id', $id)->first();
        $feature->delete();
        return redirect()->route('admin_feature_index')->with('success', 'Feature deleted successfully.');
    }
}
