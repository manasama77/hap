<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Users";
        $lists = User::with('team')->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.user.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Create Users";
        $teams      = Team::where('counter', '<', 1)->orderBy('name', 'asc')->get();

        $data = [
            'page_title' => $page_title,
            'teams'      => $teams,
        ];
        return view('pages.user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'     => 'required|unique:users,username',
            'password'     => 'required|confirmed',
            'role'         => 'required',
            'name'         => 'required',
            'phone_number' => 'required',
            'email'        => 'required',
            'photo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = Storage::disk('public')->put('pp', $request->file('photo'));

        $count_counter = Team::where('id', $request->team_id)->first();

        if ($count_counter->counter < 1) {
            $count_counter->increment('counter');
        } else {
            return redirect()->route('user.create')->withErrors('Team ' . $count_counter->name . ' is full. Please select another team.')->withInput();
        }

        $user               = new User();
        $user->username     = $request->username;
        $user->password     = bcrypt($request->password);
        $user->name         = $request->name;
        $user->phone_number = $request->phone_number;
        $user->email        = $request->email;
        $user->photo        = $filename;
        $user->role         = $request->role;
        $user->team_id      = $request->team_id ?? null;
        $user->save();

        return redirect()->route('user')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = "Edit Users";
        $data       = [
            'page_title' => $page_title,
        ];
        return view('pages.user.form_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // destory user
        $user = User::find($id);
        Storage::disk('public')->delete($user->photo);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}
