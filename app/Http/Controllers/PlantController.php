<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $plants = Plant::when($request->search, function($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->search.'%');
        })->latest()->paginate(10);

        return view('plants.index', compact('plants'));
    }

    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:flower,succulent,tree',
            'price' => 'required|numeric|min:0|max:9999.99',
            'environment' => 'required|string|in:indoor,outdoor',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storePlantImage($request->file('image'));
        }

        Plant::create($validated);

        return redirect()->route('plants.index')
            ->with('success', 'Plant created successfully!');
    }

    public function show(Plant $plant)
    {
        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|in:flower,succulent,tree',
            'price' => 'sometimes|numeric|min:0|max:9999.99',
            'environment' => 'sometimes|string|in:indoor,outdoor',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'sometimes|boolean'
        ]);

        // Handle image removal
        if ($request->remove_image && $plant->image_path) {
            $this->deletePlantImage($plant->image_path);
            $validated['image_path'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($plant->image_path) {
                $this->deletePlantImage($plant->image_path);
            }
            $validated['image_path'] = $this->storePlantImage($request->file('image'));
        }

        $plant->update($validated);

        return redirect()->route('plants.index')
            ->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant)
    {
        // Delete associated image
        if ($plant->image_path) {
            $this->deletePlantImage($plant->image_path);
        }

        $plant->delete();

        return redirect()->route('plants.index')
            ->with('success', 'Plant deleted successfully!');
    }

    protected function storePlantImage($image)
    {
        $manager = new ImageManager(new Driver());
        
        $filename = 'plant-' . time() . '.' . $image->extension();
        $path = 'plants/' . $filename;
        
        // Ensure directory exists
        Storage::disk('public')->makeDirectory('plants');
        
        // Process image
        $image = $manager->read($image->getRealPath());
        $image->scale(width: 800, height: 600);
        
        // Save to storage
        $image->save(storage_path('app/public/' . $path), quality: 80);
        
        return $path;
    }

    protected function deletePlantImage($path)
    {
        Storage::disk('public')->delete($path);
    }
}