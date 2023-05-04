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
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id'
        ]);

        Rating::create($request->all());

        return new RatingResource($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        return new RatingResource($rating);
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
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id'
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

    /* Custom functions */
    /**
     * Remove the specified resource from storage.
     */
    public function getUserRatings(int $id)
    {

        return Rating::where('user_id', '=', $id)->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getUserRating(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        return Rating::where('user_id', '=', $request['user_id'])->where('product_id', '=', $request['product_id'])->get();
    }
}
