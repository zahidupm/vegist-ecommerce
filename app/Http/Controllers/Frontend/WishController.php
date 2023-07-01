<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class WishController extends Controller
{
    public function index()
    {
        if (Cookie::get('shopping_wish')) {
            $cookie_data = stripslashes(Cookie::get('shopping_wish'));
            $wishes = json_decode($cookie_data, false);
        } else {
            $wishes = [];
        }

        return view('frontend.wish.index', ['wishes' => $wishes]);
    }

    public function addToWish(Request $request)
    {
        // return ['hello'];
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_wish')) {
            $cookie_data = stripslashes(Cookie::get('shopping_wish'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));
                    return response()->json(['message' => 'Item updated to the wish']);
                }
            }
        } else {
            $product = Product::find($prod_id);

            if ($product) {
                $prod_name = $product->title;
                $prod_image = $product->gallery[0]->name;
                $priceval = $product->price;

                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_slug' => $product->slug,
                    'item_quantity' => $quantity,
                    'item_price' => $priceval,
                    'item_image' => $prod_image,
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));
                return response()->json(['message' => 'Added to Wish']);
            }
        }
    }

    public function loadCookieData()
    {
        if (Cookie::get('shopping_wish')) {
            $cookie_data = stripslashes(Cookie::get('shopping_wish'));
            $cart_data = json_decode($cookie_data, true);
            $totalwish = count($cart_data);

            echo json_encode(array('totalwish' => $totalwish));die;
            return;
        } else {
            $totalwish = "0";
            echo json_encode(array('totalwish' => $totalwish));die;
            return;
        }
    }
}
