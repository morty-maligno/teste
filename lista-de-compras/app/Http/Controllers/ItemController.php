<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->item['name'])) {
            $name = $request->item['name'];
        } else {
            $name = null;
        }

        $buyed = $request->item['buyed'] ?? false;
        $quantity = $request->item['quantity'] ?? 0;
        $unitPrice = $request->item['unit_price'] ?? 0.0;

        $newItem = new Item;
        $newItem->name = $name;
        $newItem->buyed = $buyed;
        $newItem->quantity = $quantity;
        $newItem->unit_price = $unitPrice;
        $newItem->shopping_list_id = $request->item['shopping_list_id'];
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id); // Carrega o item do banco de dados pelo ID

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Atualiza os campos do item com os valores do request, se eles estiverem presentes
        if ($request->has('name')) {
            $item->name = $request->input('name');
        }

        if ($request->has('quantity')) {
            $item->quantity = $request->input('quantity');
        }

        if ($request->has('unit_price')) {
            $item->unit_price = $request->input('unit_price');
        }

        // Salva as mudanças no banco de dados
        $item->save();

        return response()->json($item, 200);
    }

    public function filterByShoppingList($shopping_list_id)
    {
        $items = Item::where('shopping_list_id', $shopping_list_id)->get();
        return response()->json($items);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->delete();
            return "Item deleted";
        }
        return "Item not found";
    }
}