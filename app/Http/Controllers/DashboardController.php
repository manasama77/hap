<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Team;
use App\Models\User;
use App\Models\Vendor;
use App\Models\CategoryItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $page_title = "Dashboard";
        return view('pages.dashboard.main', compact('page_title'));
    }

    public function get_count()
    {
        $user = User::count();
        $team = Team::count();
        $category_item = CategoryItem::count();
        $item = Item::count();
        $vendor = Vendor::count();

        $data = [
            'user' => $user,
            'team' => $team,
            'category_item' => $category_item,
            'item' => $item,
            'vendor' => $vendor,

        ];
        return response()->json($data);
    }
}
