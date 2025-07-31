<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $blog_categories = BlogCategory::get();
        return view('admin.blog_category.index', compact('blog_categories'));
    }

    public function create()
    {
        return view ('admin.blog_category.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:blog_categories,slug',
            
        ]);

        $blog_categories = new BlogCategory();
        $blog_categories->name = $request->name;
        $blog_categories->slug = $request->slug;
        $blog_categories->save();

        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category created successfully.');

    }

    public function edit($id)
    {
        $blog_categories = BlogCategory::where('id', $id)->first();
        return view('admin.blog_category.edit', compact('blog_categories'));
    }

    public function edit_submit(Request $request, $id)
    {
        $blog_categories = BlogCategory::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:blog_categories,slug,' . $id,
        ]);

        $blog_categories->name = $request->name;
        $blog_categories->slug = $request->slug;
        $blog_categories->save();

        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category updated successfully.');
    }

    public function delete($id)
    {
        $blog_categories = BlogCategory::where('id', $id)->first();
        $blog_categories->delete();
        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category deleted successfully.');
    }
}
