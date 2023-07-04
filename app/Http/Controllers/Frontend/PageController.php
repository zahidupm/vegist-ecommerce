<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Request;

class PageController extends Controller
{
    public function home()
    {

        $sliders = Slider::latest()->get();
        $categories = Category::latest()->get();

        return view('frontend.home.index', compact('sliders', 'categories'));
    }

    public function shop()
    {
        $products = Product::latest()->paginate();

        return view('frontend.shop.index', ['products' => $products]);
    }

    public function singleProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('frontend.shop.single', compact('product'));
    }

    // Single Product
    public function singleAjaxProduct(Request $request)
    {
        $product = Product::with('gallery')->where('slug', $request->slug)->first();

        return [
            'product' => $product,
        ];
    }
}
