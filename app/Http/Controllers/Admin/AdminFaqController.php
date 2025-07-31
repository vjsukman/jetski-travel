<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view ('admin.faq.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            
        ]);

        $faqs = new Faq();
        $faqs->question = $request->question;
        $faqs->answer = $request->answer;
        $faqs->save();

        return redirect()->route('admin_faq_index')->with('success', 'Faqs created successfully.');

    }

    public function edit($id)
    {
        $faqs = Faq::where('id', $id)->first();
        return view('admin.faq.edit', compact('faqs'));
    }

    public function edit_submit(Request $request, $id)
    {
        $faqs = Faq::where('id', $id)->first();

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faqs->question = $request->question;
        $faqs->answer = $request->answer;
        $faqs->save();

        return redirect()->route('admin_faq_index')->with('success', 'Faqs updated successfully.');
    }

    public function delete($id)
    {
        $faqs = Faq::where('id', $id)->first();
        $faqs->delete();
        return redirect()->route('admin_faq_index')->with('success', 'Faqs deleted successfully.');
    }
}
