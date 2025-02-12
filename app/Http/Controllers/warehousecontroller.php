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
    
    // Set warehouse_id of associated products to null
    productmodel::where('warehouse_id', $id)->update(['warehouse_id' => null]);
    
    $warehouse->delete();
    return redirect()->route('warehouse.main');
}




}
