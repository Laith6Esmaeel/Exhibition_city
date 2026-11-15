<?php

namespace App\Http\Controllers;

use App\Models\Trend;

class TrendController extends Controller
{
    public function addTrend($id)
    {
        Trend::firstOrCreate([
            'product_id' => $id
        ]);
        return response()->json(__('words.The trend product has been added'));
    }

    public function showTrend()
    {
        $trends = Trend::where('admission', 'accepted')->get();
        // $product = $trend->products;
        foreach ($trends as $trend) {
            $trend->products->image = asset('images/' . $trend->products->image);
            $product[] = $trend->products;
        }
        return response()->json($product);
    }


    public function deleteTrend($id)
    {
        $trend = Trend::find($id);
        $trend->delete;
        return response()->json(__('words.The trend product has been delete'));
    }
}
