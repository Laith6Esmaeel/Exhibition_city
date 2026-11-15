<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function allDis()
    {
        $dis = Discount::all();
        foreach ($dis as $d) {
            $product = $d->products;
            $product->image = asset('images/' . $product->image);
        }
        return response()->json($dis);
    }


    public function addDis(Request $request, $id)
    {
        $request->validate([
            'discount',
            'expiry_time'
        ]);

        $dis = $request->all();
        $dis['product_id'] = $id;
        Discount::create($dis);
        return response()->json(__('words.Discount added'));
    }

    public function showDis($id)
    {
        $discounts = Discount::find($id);
        $products = $discounts->products;
        $products['image'] = asset('images/' . $products->image);
        return response()->json($discounts);
    }


    public function deleteDis($id)
    {
        $dis = Discount::find($id);
        $dis->delete;
        return response()->json(__('words.The discount has been deleted'));
    }
}
