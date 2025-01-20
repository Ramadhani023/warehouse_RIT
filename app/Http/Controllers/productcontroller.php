<?php

namespace App\Http\Controllers;

use App\Models\Borrowmodel;
use Illuminate\Http\Request;
use App\Models\productmodel;
use App\Models\categorymodel;
use App\Models\warehousemodel;

class productcontroller extends Controller
{
    // Show products
    public function showproductForm($id, Request $request)
    {
        // Fetch products related to this specific warehouse
        $query = productmodel::where('warehouse_id', $id)->with('category');

        // Search functionality
        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        // Get count for available stock, low stock, and out of stock
        $availableStockCount = $products->where('product_qty', '>', 10)->count();
        $lowStockCount = $products->where('product_qty', '>', 0)->where('product_qty', '<=', 10)->count();
        $outOfStockCount = $products->where('product_qty', '=', 0)->count();

        // Fetch categories for product form (if needed)
        $category = categorymodel::all();

        // Assuming you have a Warehouse model and relationship with products
        $warehouse = warehousemodel::find($id);

        if (!$warehouse) {
            // Handle the case where the warehouse is not found
            return redirect()->route('warehouse.main')->with('error', 'Warehouse not found');
        }

        // Pass the products, stock counts, categories, and warehouse ID to the view
        return view('warehouse.inside', compact(
            'products',
            'category',
            'warehouse',
            'id',
            'availableStockCount',
            'lowStockCount',
            'outOfStockCount'
        ));
    }
    
    // Add a new product
    public function add(Request $request)
    {
        productmodel::create([
            'product_name' => $request->product_name,
            'product_category' => $request->product_category,
            'product_qty' => $request->product_qty,
            'warehouse_id' => $request->warehouse_id, // Assuming warehouse_id is also passed in the request
            'category_id' => $request->product_category, // Assuming product_category is also passed in the request
            'serial' => $request->serial,
            'manufaktur' => $request->manufaktur,
            'last_inspection' => $request->last_inspection,
            'next_inspection' => $request->next_inspection,
        ]);

        return redirect()->route('warehouse.inside', ['id' => $request->warehouse_id]);
    }

    // Edit an existing product
    public function edit(Request $request, $id)
    {
        $product = productmodel::findOrFail($id);
        $warehouse_id = $product->warehouse_id;
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_qty = $request->product_qty;
        $product->serial = $request->serial;
        $product->manufaktur = $request->manufaktur;
        $product->last_inspection = $request->last_inspection;
        $product->next_inspection = $request->next_inspection;
        
        $product->save();

        return redirect()->route('warehouse.inside', ['id' => $warehouse_id]);
    }

    // Delete a product
    public function delete($id, Request $request)
    {
        $product = productmodel::findOrFail($id);
        $warehouse_id = $product->warehouse_id;
        $product->delete();

        // Ensure the warehouse_id is passed correctly to the redirect
        return redirect()->route('warehouse.inside', ['id' => $warehouse_id]);
    }

    public function showInvoice()
    {
        // Fetch all products (or filter them if needed)
        $products = productmodel::with('category', 'warehouse')->get();

        // Get count for available stock, low stock, and out of stock
        $availableStockCount = $products->where('product_qty', '>', 10)->count();
        $lowStockCount = $products->where('product_qty', '>', 0)->where('product_qty', '<=', 10)->count();
        $outOfStockCount = $products->where('product_qty', '=', 0)->count();

        // Pass the data to the view
        return view('invoice.invoice', compact('products', 'availableStockCount', 'lowStockCount', 'outOfStockCount'));
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'borrower_name' => 'required|string|max:255',
            'borrow_item_name' => 'required|string|max:255',
            'borrow_qty' => 'required|integer|min:1',
        ]);
    
        try {
            $product = productmodel::findOrFail($request->input('product_id'));
    
            if ($product->product_qty < $request->input('borrow_qty')) {
                return redirect()->back()->with('error', 'Insufficient stock to borrow.');
            }
    
            $product->product_qty -= $request->input('borrow_qty');
            $product->save();
    
            Borrowmodel::create([
                'item_name' => $request->input('borrow_item_name'),
                'qty' => $request->input('borrow_qty'),
                'borrower' => $request->input('borrower_name'),
                'status' => 'not returned',
            ]);
    
            return redirect()->route('warehouse.inside', ['id' => $product->warehouse_id])->with('success', 'Product borrowed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    
}
