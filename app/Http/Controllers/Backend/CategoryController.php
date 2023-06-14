<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(10);

        return view('backend.category.index', compact('categories'));
    }

    //create a new slider
    public function create(Request $request){

        if($request->isMethod('POST')){
            $request->validate([
                'name'      => 'required|string|max:255',
                'slug'       => 'nullable|string|max:255',
                'thumbnail'  => 'nullable',
            ]);

            $thumb = '';
            if (!empty($request->file('thumbnail'))) {
                $thumb = time() . '-' . str_replace(' ', '--', $request->file('thumbnail')->getClientOriginalName());
                // Store the thumbnail
                $request->file('thumbnail')->storeAs('/', $thumb);
            }

            Category::create([
                'name'      => $request->name,
                'slug'       => $request->slug,
                'thumbnail'  => $thumb,
            ]);

            flash()->addSuccess('Category created successfully');

            return redirect()->back()->with('success', 'Category updated successfully');
        }
        return view('backend.category.create');
    }


    public function edit(Request $request, $id){
        $category = Category::findOrFail($id);

        if($request->isMethod('PUT')){
            $request->validate([
                'name'      => 'required|string|max:255',
                'slug'       => 'nullable|string|max:255',
                'thumbnail'  => 'nullable',
            ]);

            $thumb = $category->thumbnail;

            if(!empty($request->file('thumbnail'))){
                Storage::delete('/' . $thumb);
                $thumb = time() . '-' . str_replace(' ', '--', $request->file('thumbnail')->getClientOriginalName());
                // store the background
                $request->file('thumbnail')->storeAs('/', $thumb);
            }

            // Slider Update
            $category->update([
                'name'      => $request->name,
                'slug'       => $request->slug,
                'thumbnail' => $thumb,
            ]);
            flash()->addSuccess('Category updated successfully');
            return redirect()->back()->with('success', 'Category updated successfully');
        }

        return view('backend.category.edit', compact('category'));
    }


    // Delete a slider
    public function delete($id)
    {
        $category = Category::find($id);
        // Delete image
        Storage::delete('/' . $category->background);

        $category->delete();
        // Return
        flash()->addSuccess('Deleted Successfully');
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
