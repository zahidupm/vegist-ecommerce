<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('backend.product.index', compact('products'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->all());

            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'excerpt' => 'nullable',
                'description' => 'nullable',
                'category_id' => 'required|not_in:none',
                'price' => 'required|numeric',
                'gallery' => 'required',
            ]);

            $option = json_encode($request->option);

            $product = Product::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'excerpt' => $request->excerpt,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'option' => $option,
                'price' => $request->price,
            ]);

            //Gallery
            if (!empty($request->file('gallery'))) {

                foreach ($request->file('gallery') as $image) {
                    $thumb = time() . '-' . str_replace(' ', '--', $image->getClientOriginalName());

                    // store the image
                    $image->storeAs('/products', $thumb);

                    Gallery::create([
                        'name' => $thumb,
                        'product_id' => $product->id,
                    ]);
                }
            }

            flash()->addSuccess('Product crated successfully');
            return redirect()->route('product.index');
        }

        $categories = Category::get(['id', 'name']);
        // return view('backend.product.create', compact('categories'));
        return view('backend.product.create', ['categories' => $categories]);
    }

    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->isMethod('PUT')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'excerpt' => 'nullable',
                'description' => 'nullable',
                'category_id' => 'required|not_in:none',
                'price' => 'required|numeric',
                'gallery' => 'nullable',
            ]);

            $option = json_encode($request->option);

            // Slider Update
            $product->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'excerpt' => $request->excerpt,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'option' => $option,
                'price' => $request->price,
            ]);

            //Gallery
            if (!empty($request->file('gallery'))) {

                foreach ($request->file('gallery') as $image) {
                    $thumb = time() . '-' . str_replace(' ', '--', $image->getClientOriginalName());

                    // store the image
                    $image->storeAs('/products', $thumb);

                    Gallery::create([
                        'name' => $thumb,
                        'product_id' => $product->id,
                    ]);
                }
            }

            flash()->addSuccess('Product updated successfully');
            return redirect()->route('product.index');
        }

        $categories = Category::get(['id', 'name']);

        return view('backend.product.edit', compact('product', 'categories'));
    }

    // Delete a Product
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('/products' . $product->gallery);
        $product->delete();

        flash()->addSuccess('Product deleted successfully');
        return redirect()->route('product.index');
    }
}
