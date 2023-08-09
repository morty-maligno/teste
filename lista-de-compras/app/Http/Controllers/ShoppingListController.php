<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingList;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the shopping lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ShoppingList::orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created shopping list in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->name)) {
            $name = $request->name;
        } else {
            $name = null;
        }

        $newList = new ShoppingList;
        $newList->name = $name;
        $newList->save();

        return $newList;
    }

    /**
     * Update the specified shopping list in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingList = ShoppingList::find($id);

        if ($existingList) {
            $existingList->name = $request->name;
            $existingList->save();
            return $existingList;
        }

        return "Shopping list not found";
    }

    /**
     * Remove the specified shopping list from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingList = ShoppingList::find($id);
        if ($existingList) {
            $existingList->delete();
            return "Shopping list deleted";
        }
        return "Shopping list not found";
    }
}