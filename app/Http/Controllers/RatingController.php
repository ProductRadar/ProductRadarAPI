<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RatingResource::collection(Rating::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|between:0,99.99',
            'user_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        Rating::create($request->all());

        return new RatingResource($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'rating' => 'required|numeric|between:0,99.99',
            'user_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);
        $rating->update($request->all());
        return new RatingResource($rating);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return null;
    }
}
