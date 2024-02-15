<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Item;
use App\Models\CategoryItem;
use App\Models\TipeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title     = "Items";
        $lists          = Item::with(['category_item', 'tipe_item'])->orderBy('id', 'desc');

        if (auth()->user()->role == 'teknisi') {
            $lists->where('teknisi_id', auth()->id());
        }

        $lists          = $lists->get();
        $category_items = CategoryItem::orderBy('id', 'desc')->get();
        $tipe_items     = TipeItem::orderBy('id', 'desc')->get();

        $data = [
            'page_title'     => $page_title,
            'lists'          => $lists,
            'category_items' => $category_items,
            'tipe_items'     => $tipe_items,
        ];
        return view('pages.item.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_item_id' => 'required',
            'name'             => 'required',
            'unit'             => 'required',
            'photo'            => 'nullable',
            'has_sn'           => 'nullable',
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = Storage::disk('public')->put('item', $request->photo);
            }

            Item::create([
                'category_item_id' => $request->category_item_id,
                'name'             => $request->name,
                'unit'             => $request->unit,
                'photo'            => $photo,
                'has_sn'           => $request->has_sn ? 1 : 0,
            ]);

            return redirect()->route('item')->with('success', 'Item created successfully');
        } catch (Exception $e) {
            return redirect()->route('item')->with('error', 'Item created failed');
        }
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
        //
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
        //
    }
}
