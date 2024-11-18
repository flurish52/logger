<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
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
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();
        return $newItem;
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
    public function edit(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem){
            return $existingItem;
            dd($existingItem);
        }
        return "Item not found";
    }

     public function corrected(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem){
            $existingItem->name = $request->name;
//            $existingItem->update_at = Carbon::now();
            $existingItem->save();
           return $existingItem;
        }
        return "Item not found";
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $existingItem = Item::find($id);
        echo $existingItem;
            if ($existingItem){
//                $existingItem->name = $request->name;

                $existingItem->completed_at = $existingItem->completed_at ? null :   Carbon::now();
                $existingItem->completed = !$existingItem->completed;

                $existingItem->save();


                return $existingItem;
            }
            return 'Item not found.';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem){
            $existingItem->delete();
            return 'Item deleted successfully';
        };
      return 'Item not found';
    }
}
