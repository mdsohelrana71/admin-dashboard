<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductBrand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all product brands from the database
        $brands = ProductBrand::all();

        // Return the view with the brands data
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create-brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_brands,name',
            'slug' => 'nullable|string|max:255|unique:product_brands,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $logo = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('product-brands', 'public');
        }
        
        ProductBrand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $logo,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.product-brands.index')
            ->with('success', 'Product brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = ProductBrand::findOrFail($id);
        return view('admin.brand.show-brand', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = ProductBrand::findOrFail($id);
        return view('admin.brand.edit-brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = ProductBrand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:product_brands,name,' . $brand->id,
            'slug' => 'nullable|string|max:255|unique:product_brands,slug,' . $brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $brand->logo = $request->file('logo')->store('product-brands', 'public');
        }

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status ?? 0;
        $brand->sort_order = $request->sort_order ?? 0;

        $brand->save();

        return redirect()
            ->route('admin.product-brands.index')
            ->with('success', 'Product brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = ProductBrand::findOrFail($id);

        // Delete the logo if it exists
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()
            ->route('admin.product-brands.index')
            ->with('success', 'Product brand deleted successfully.');
    }
}
