<?php

namespace App\Http\Controllers;

use App\Models\categorymodel;
use App\Models\productmodel;
use App\Models\warehousemodel;
use Illuminate\Http\Request;

class warehousecontroller extends Controller
{
    function main() {
        $warehouse = warehousemodel::get();
        return view('warehouse.main', compact('warehouse'));
    }

    public function cw(){
        return view('warehouse.contentWh');
    }

    function add(Request $request) {
        $warehouse = new warehousemodel();
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->save();
    
        return redirect()->route('warehouse.main');
    }

    public function showWarehouse($warehouseId, Request $request)
    {
        $warehouse = warehousemodel::findOrFail($warehouseId);
        $category = categorymodel::all(); // Ensure this fetches all category
        $search = $request->input('search');
        
        $products = productmodel::where('warehouse_id', $warehouseId)
            ->when($search, function ($query, $search) {
                $query->where('product_name', 'LIKE', "%{$search}%")
                      ->orWhere('serial', 'LIKE', "%{$search}%")
                      ->orWhereHas('category', function ($query) use ($search) {
                          $query->where('category_name', 'LIKE', "%{$search}%");
                      });
            })
            ->get();
    
        return view('warehouse.inside', compact('warehouse', 'products', 'category'));
    }

    public function show($id)
{
    $category = categorymodel::all(); // Fetch all categoryzzz
    
    $warehouse = warehousemodel::find($id);

    $products = productmodel::where('warehouse_id' , $id)->get();


    return view('warehouse.inside', compact('warehouse', 'category', 'products'));
}

function update(Request $request, $id) {
    $warehouse = warehousemodel::find($id);

    if ($warehouse) {
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->save(); // Use save() to persist changes.
    }

    return redirect()->route('warehouse.main'); // Redirect to the main page
}


function delete($id){
    $warehouse = warehousemodel::find($id);
    $warehouse->delete();
    return redirect()->route('warehouse.main');
}




}
