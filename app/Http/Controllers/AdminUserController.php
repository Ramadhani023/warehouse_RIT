<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Borrowmodel;
use App\Models\productmodel;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Display the borrow index page
    // Display the borrow index page
    public function borrowIndex()
    {
        $borrows = Borrowmodel::all(); // Fetch all borrow transactions
        return view('admin.borrow.index', compact('borrows'));
    }

    // Handle the return action (delete the item from the list)
    public function returnItem($id)
    {
        $borrow = Borrowmodel::findOrFail($id); // Find the borrow record by ID
        $product = productmodel::where('product_name', $borrow->item_name)->first(); // Find the product by item name
    
        if (!$product) {
            return redirect()->route('admin.borrow.index')->with('error', 'Product not found.');
        }
    
        $product->product_qty += $borrow->qty; // Update the quantity of the product
        $product->save(); // Save the changes
    
        $borrow->status = 'returned'; // Update the status to "returned"
        $borrow->save(); // Save the changes
    
        return redirect()->route('admin.borrow.index')->with('success', 'Item status updated to returned.');
    }

    public function destroyBorrow($id)
    {
        $borrow = Borrowmodel::findOrFail($id); // Find the borrow record by ID
        $borrow->delete(); // Delete the record

        return redirect()->route('admin.borrow.index')->with('success', 'Borrow record deleted successfully.');
    }

    // Edit user details
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user details
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,user',
        ]);

        $user->update($request->only(['name', 'email', 'role']));
        return redirect()->route('admin.users.index')->with('success', 'User  updated successfully');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete an admin user.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User  deleted successfully');
    }
}