<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function addFavourite($id)
    {
        Favourite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);
        return response()->json(__('words.Added to favorites'));
    }
    public function allFavouriteForUser()
    {
        $user = User::find(Auth::id());
        $favourites = $user->favourite;
        foreach ($favourites as $favourite) {
            $favourite->image = asset('images/' . $favourite->image);
        }
        return response()->json($favourites);
    }

    public function allFavouriteForProduct($id)
    {
        $product = Product::find($id);
        $favourites = $product->favourite;
        return response()->json($favourites);
    }

    // public function deleteFavourite($id){
    //     $user = User::find(Auth::id());
    //     $favourites=$user->favourite;
    //     foreach($favourites as $fav){
    //         if($fav->id==$id){

    //         }
    //     }

    // }


}
