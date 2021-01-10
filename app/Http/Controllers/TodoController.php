<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Auth;


class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function index()
//    {
////        return "test";
//
//        $products = Product::all();
//
//        return response()->json($products);
//
//    }

    public function create(Request $request)
    {

        return Auth::user();
        $record = new Todo();

        $record->category= $request->category;
        $record->todo = $request->todo;
        $record->user_id = $request->user_id;
        $record->description= $request->description;

        $record->save();

        return response()->json($record);
    }

//    public function show($id)
//    {
//        $product = Product::find($id);
//
//        return response()->json($product);
//    }
//
//    public function update(Request $request, $id)
//    {
//        $product= Product::find($id);
//
//        $product->name = $request->input('name');
//        $product->price = $request->input('price');
//        $product->description = $request->input('description');
//        $product->save();
//        return response()->json($product);
//    }
//
//    public function destroy($id)
//    {
//        $product = Product::find($id);
//        $product->delete();
//
//        return response()->json('product removed successfully');
//    }


}
