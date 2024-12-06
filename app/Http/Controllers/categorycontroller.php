<?php

namespace App\Http\Controllers;

use App\Models\categorymodel;
use App\Models\productmodel;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{
    // Show categories
    public function showcategoryForm()
    {
        $category = categorymodel::all(); // Fetch all categories
        $product = productmodel::all();  // Assuming you need to show products too in the same view
        return view('warehouse.inside', compact('category', 'product'));
    }

    // Add a new category
    public function add(Request $request)
    {
        $category = new categorymodel();
        $category->category_name = $request->category_name;
        $category->save();
    
        // Get the warehouse_id from the form request
        $warehouseId = $request->warehouse_id;
    
        // Redirect to the warehouse.inside route with the warehouse ID
        return redirect()->route('warehouse.inside', ['id' => $warehouseId]);
    }
}
