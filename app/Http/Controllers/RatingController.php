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
     *
     * @param Request $request
     * @param Rating $rating
     * @return RatingResource
     */
    public function update(Request $request, Rating $rating): RatingResource
    {
        $request->validate([
            'rating' => 'required|numeric|between:0,99.99',
            'product_id' => 'required|integer|exists:products,id'
        ]);

        // Gets the user that made the request
        $user_id = $request->user()['id'];

        // If user_id and product_id exists update the rating otherwise create it
        $rating = $rating->updateOrCreate(
            ['user_id' => $user_id, 'product_id' => $request->input('product_id')],
            ['rating' => $request->input('rating')]
        );

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
     * Get user ratings by logged-in user id
     */
    public function getUserRatings(Request $request)
    {
        $user_id = $request->user()['id'];
        $rating = Rating::where('user_id', '=', $user_id)->get();
        return RatingResource::collection($rating);
    }

    /**
     * Get a specific rating by logged-in user id and product id
     */
    public function getUserRating(Request $request, int $product_id)
    {
        $user_id = $request->user()['id'];
        $rating = Rating::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->get();
        return RatingResource::collection($rating);
    }

    /**
     * Get a specific rating by product id
     */
    public function getProductRating(int $product_id)
    {
        $rating = Rating::where('product_id', '=', $product_id)->get();
        return RatingResource::collection($rating);
    }
}
