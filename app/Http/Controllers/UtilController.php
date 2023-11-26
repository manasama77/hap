<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function get_list_item()
    {
        $item = Item::with([
            'category_item',
        ])->get();

        return response()->json([
            'data' => $item
        ]);
    }
}
