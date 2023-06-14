<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->paginate(10);

        return view('backend.slider.index', compact('sliders'));
    }

    //create a new slider
    public function create(Request $request){

        if($request->isMethod('POST')){
            $request->validate([
                'title'      => 'required|string|max:255',
                'sub_title'  => 'nullable|string|max:255',
                'btn_text'   => 'nullable|string|max:255',
                'btn_link'   => 'nullable|string|max:255',
                'alignment'  => 'required|in:left,right,center',
                'background' => 'required',
            ]);

            $background = ' ';
            if(!empty($request->file('background'))){
                $background = $request->file('background')->getClientOriginalName();
                $background = str_replace(' ', '--', $background);
                $background = time() . '-' . $background;
                // store the background
                $request->file('background')->storeAs('/', $background);
            }

            Slider::create([
                'title'      => $request->title,
                'sub_title'  => $request->sub_title,
                'btn_link'   => $request->btn_link,
                'btn_text'   => $request->btn_text,
                'alignment'  => $request->alignment,
                'background' => $background,
            ]);

            flash()->addSuccess('Slider created successfully');

            return redirect()->back()->with('success', 'Slider updated successfully');
        }
        return view('backend.slider.create');
    }


    public function edit(Request $request, $id){
        $slider = Slider::findOrFail($id);

        if($request->isMethod('PUT')){
            $request->validate([
                'title'      => 'required|string|max:255',
                'sub_title'  => 'nullable|string|max:255',
                'btn_text'   => 'nullable|string|max:255',
                'btn_link'   => 'nullable|string|max:255',
                'alignment'  => 'required|in:left,right,center',
            ]);

            $background = $slider->background;

            if(!empty($request->file('background'))){
                Storage::delete('/' . $background);
                $background = $request->file('background')->getClientOriginalName();
                $background = str_replace(' ','--', $background);
                $background = time() . '-' . $background;
                // store the background
                $request->file('background')->storeAs('/', $background);
            }

            // Slider Update
            $slider->update([
                'title'      => $request->title,
                'sub_title'  => $request->sub_title,
                'btn_text'   => $request->btn_text,
                'btn_link'   => $request->btn_link,
                'alignment'  => $request->alignment,
                'background' => $background,
            ]);
            flash()->addSuccess('Slider updated successfully');
            return redirect()->back()->with('success', 'Slider updated successfully');
        }

        return view('backend.slider.edit', compact('slider'));
    }


    // delete a slider
    // public function delete($id){
    //     $slider = Slider::find($id);
    //     // delete image
    //     Storage::delete('/' . $slider->background);

    //     $slider->delete();

    //     flash()->addSuccess('Deleted Successfully');
    //     return redirect()->back()->with('Success', 'Deleted slider successfully');
    // }

    // Delete a slider
    public function delete($id)
    {
        $slider = Slider::find($id);
        // Delete image
        Storage::delete('/' . $slider->background);

        $slider->delete();
        // Return
        flash()->addSuccess('Deleted Successfully');
        return redirect()->back()->with('success', 'Slider Deleted Successfully');
    }


}
