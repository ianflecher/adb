<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;



class ProductController extends Controller
{
    public function index()
{
    $categories = Category::all();
    $products = Product::with('category')
        ->when(request('category'), function ($query, $category) {
            return $query->where('category_id', $category);
        })
        ->paginate(10);

    if (request()->is('admin/dashboard')) {
        return view('admin.dashboard', compact('products', 'categories'));
    }

    return view('user.landingpage', compact('products', 'categories'));
}



public function filterByCategory($id)
{
    $categories = Category::all();
    $products = Product::where('category_id', $id)->with('category')->get();

    return view('admin.dashboard', compact('products', 'categories'));
}



    // Show the form for creating a new product
    public function create()
    {
        return view('product.add');
    }

    // Store a newly created product in the database
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'details' => 'nullable|string',
    ]);

    // Map category name to an ID
    $categories = [
        'fruits_vegetables' => 1,
        'legumes_beans' => 2,
        'grains_cereals' => 3,
        'nuts_seeds' => 4,
        'plant_based_proteins' => 5,
        'dairy_alternatives' => 6,
        'breads_wraps' => 7,
        'condiments_sauces' => 8,
        'vegan_snacks' => 9,
        'desserts_sweets' => 10,
    ];
    

    // Convert category name to ID
    if (!isset($categories[$validated['category']])) {
        return back()->withErrors(['category' => 'Invalid category selected.']);
    }

    $validated['category_id'] = $categories[$validated['category']];
    unset($validated['category']); // Remove original category name

    // Create product
    $product = Product::create($validated);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('product'), $imageName);
        $product->image = $imageName;
        $product->save();
    }

    return redirect()->route('admin.dashboard')->with('success', 'Product added successfully.');
}


    // Display the specified product
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    // Update the specified product in the database
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'details' => 'nullable|string',
        ]);

        $product->update($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/product');
            $product->image = basename($imagePath);
            $product->save();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from the database
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}
