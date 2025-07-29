<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;

class AdminTeamMemberController extends Controller
{
    public function index()
    {
        $team_member = TeamMember::all();
        return view('admin.team_member.index', compact('team_member'));
    }

    public function create()
    {
        return view ('admin.team_member.create');
    }
    
    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:team_members,slug',
            'designation' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'biography' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $finalName = 'team_member_'.time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/team_members'), $finalName);

        $team_member = new TeamMember();
        $team_member->name = $request->name;
        $team_member->slug = $request->slug;
        $team_member->designation = $request->designation;
        $team_member->address = $request->address;
        $team_member->email = $request->email;
        $team_member->phone = $request->phone;
        $team_member->biography = $request->biography;
        $team_member->facebook = $request->facebook;
        $team_member->twitter = $request->twitter;
        $team_member->linkedin = $request->linkedin;
        $team_member->instagram = $request->instagram;
        $team_member->photo = $finalName;
        $team_member->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Team Member created successfully.');

    }

    public function edit($id)
    {
        $team_member = TeamMember::where('id', $id)->first();
        return view('admin.team_member.edit', compact('team_member'));
    }

    public function edit_submit(Request $request, $id)
    {
        $team_member = TeamMember::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:team_members,slug,'. $team_member->id,
            'designation' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'biography' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            
            $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            unlink(public_path('uploads/team_members/' . $team_member->photo));

            $finalName = 'team_member_'.time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/team_members'), $finalName);
            $team_member->photo = $finalName;
        }

        $team_member->name = $request->name;
        $team_member->slug = $request->slug;
        $team_member->designation = $request->designation;
        $team_member->address = $request->address;
        $team_member->email = $request->email;
        $team_member->phone = $request->phone;
        $team_member->biography = $request->biography;
        $team_member->facebook = $request->facebook;
        $team_member->twitter = $request->twitter;
        $team_member->linkedin = $request->linkedin;
        $team_member->instagram = $request->instagram;
        $team_member->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Team Member updated successfully.');
    }

    public function delete($id)
    {
        $team_member = TeamMember::where('id', $id)->first();
        unlink(public_path('uploads/team_members/' . $team_member->photo));
        $team_member->delete();
        return redirect()->route('admin_team_member_index')->with('success', 'Team Member deleted successfully.');
    }
}
