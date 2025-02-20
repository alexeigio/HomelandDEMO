<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $property_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'property_id' => $property_id,
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'rating' => $request->rating,
            'date' => now(),
        ]);

        return redirect()->back()->with('message', 'Review submitted successfully!');
    }
}
