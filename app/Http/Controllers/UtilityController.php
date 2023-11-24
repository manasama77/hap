<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function get_technician_unassign()
    {
        $exec = User::where('role', 'teknisi')->get();
        return response()->json($exec);
    }

    public function assign_technician(Request $request)
    {
        $request->validate([
            'team_id'       => 'required',
            'technician_id' => 'required'
        ]);

        User::where('team_id', $request->team_id)->update(['team_id' => null]);
        foreach ($request->technician_id as $key) {
            $exec = User::find($key);
            $exec->team_id = $request->team_id;
            $exec->save();
        }

        return response()->json($exec);
    }
}
