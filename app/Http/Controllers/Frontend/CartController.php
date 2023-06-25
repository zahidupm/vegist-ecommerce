<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $quantity;
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart', 'status2' => '2']);
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
                    'item_quantity' => $quantity,
                    'item_price' => $priceval,
                    'item_image' => $prod_image,
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
            }
        }

    }

    public function loadCookieData()
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);

            echo json_encode(array('totalcart' => $totalcart));die;
            return;
        } else {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart));die;
            return;
        }
    }

    // public function loadCookieData()
    // {
    //     if (Cookie::get('shopping_cart')) {
    //         $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    //         $cart_data = json_decode($cookie_data, true);
    //         $total_cart = count($cart_data);
    //     } else {
    //         $total_cart = 0;
    //     }

    //     return response()->json(['total_cart' => $total_cart]);
    // }

}
