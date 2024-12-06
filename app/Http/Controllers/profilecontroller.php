<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\warehousemodel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class profilecontroller extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show(Request $request)
    {
        return view('profile.main', [
            'user' => $request->user(),
        ]);
    }

    public function show2()
    {
        $warehouses = warehousemodel::all(); // Fetch all warehouses (or filter based on user, if needed)
        return view('profile.main', compact('warehouses')); // Pass warehouses to the view
    }


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'dob' => $request->input('dob'),
        ]);

        return Redirect::route('profile.main')->with('status', 'Profile updated successfully!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'], // Optional: if you want password validation
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Account deleted successfully!');
    }
}
