<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Item;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
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
     * @return Item
     */
    public function store(StoreItemPost $request)

    {
        $request->validated();
//        $validator = $this->$request->validate($request, [
//            'category' => ['required'],
//            'name' => 'required', 'string', 'max:20',
//            'price' => ['required','numeric'],
//            'available' => ['required', 'int'],
//            'weight' => ['required','numeric'],
//        ]);

        $newItem = new Item;
        $newItem->category = $request->item["category"];
        $newItem->name = $request->item["name"];
        $newItem->price = $request->item["price"];
        $newItem->available = $request->item["available"];
        $newItem->weight = $request->item["weight"];
        $newItem->save();

//        if($validator->passes()){
//            Item::create($request->all());
//
//            return response()->json([], 201);
//        }
//
//        $errors = json_decode($validator->errors());
//
//        return response()->json([
//            'success' => false,
//            'message' => $errors
//        ],422);

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        $existingItem = Item::find( $id );
        if($existingItem) {
            $existingItem->save();
            return $existingItem;
        }
        return "Item not found";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function edit(Request $request, $id)
    {
//        dd($request->all());
        $editItem = Item::find($id);
        if ($editItem) {
            $editItem->category = $request->item['category'];
            $editItem->name = $request->item["name"];
            $editItem->price = $request->item["price"];
            $editItem->available = $request->item["available"];
            $editItem->weight = $request->item["weight"];
            $editItem->save();

            return $editItem;
        }
        return "Item not found";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->save();
            return $existingItem;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id): string
    {
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->delete();
            return "Item deleted";
        }
        return "Item not found";
    }

//    /**
//     * @return \string[][]
//     */
//    public function rules()
//    {
//        return [
//            'category' => ['required'],
//            'name' => ['required', 'string', 'max:20'],
//            'price' => ['required','numeric'],
//            'available' => ['required', 'int'],
//            'weight' => ['required','numeric'],
//        ];
//    }

}
