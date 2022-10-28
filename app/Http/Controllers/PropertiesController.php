<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PropertiesController extends Controller
{

    public function properties()
    {
        $title = 'Home';
        $properties = Properties::all();
        return View::make('index')
            ->with('title', $title)
            ->with(compact('properties'));
    }

    public function indexProperties()
    {
        $title = 'Detail Properties';
        $properties = Properties::all();
        return View::make('controls.admins.index-properties')
            ->with('title', $title)
            ->with(compact('properties'));
    }

    public function addProperties(Request $request)
    {
        $validated = $request->validate([
            'properties_name' => 'required',
            'type' => 'required',
            'model' => 'required',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
            'properties_description' => 'required',
            'price' => 'required',
            'notelp' => 'required',
        ]);
        
        $imgName = [];
        foreach ($request->file('image') as $img) {
            $filename = $img->getClientOriginalName();
            $img->move(public_path() . '/images/blueprints', $filename);
            $imgName[] = $filename;
        }
        $post = new Properties;
        $post->properties_name = $request->properties_name;
        $post->type = $request->type;
        $post->model = $request->model;
        $post->properties_description = $request->properties_description;
        $post->price = $request->price;
        $post->notelp = $request->notelp;
        $post->image = json_encode($imgName);

        $post->save();
        return redirect("index-properties")
            ->with('success', 'You have successfully created the properties.');
    }

    public function updateProperties($id)
    {
        $properties = Properties::find($id);
        return View('controls.admins.update-properties', compact('properties'));
    }

    public function updateDataProperties(Request $request, $id)
    {
        $properties = Properties::find($id);
        $imgName = [];
        foreach ($request->file('image') as $img) {
            $filename = $img->getClientOriginalName();
            $img->move(public_path() . '/images/blueprints', $filename);
            $imgName[] = $filename;
        }
        $properties->properties_name = $request->properties_name;
        $properties->type = $request->type;
        $properties->model = $request->model;
        $properties->properties_description = $request->properties_description;
        $properties->price = $request->price;
        $properties->notelp = $request->notelp;
        $properties->image = json_encode($imgName);

        $properties->save();
        return redirect('index-properties')->with('updateAlert', 'Great! Properties has been successfully uptodate.');
    }

    public function destroyProperties($id)
    {
        $properties = Properties::find($id);
        $properties->delete();  
        return response('Post deleted successfully.', 200);
    }
}
