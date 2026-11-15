<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $name = $request->all();
        $products = Product::where('name', $name)->get();
        if ($products) {
            foreach ($products as $product) {
                $product->image = asset('images/' . $product->image);
            }
            return response()->json($products);
        } else {
            return response()->json(__('words.There is no product with this name'));
        }
    }
}
