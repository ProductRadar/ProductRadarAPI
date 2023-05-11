<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FavoriteResource::collection(Favorite::all());
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
            'product_id' => 'required|integer|exists:products,id'
        ]);

        // Gets the user id
        $user_id = $request->user()['id'];

        // Add the favorite, if there is not one, since this table is only supposed to hold the favorite
        $favorite = Favorite::firstOrCreate(['user_id' => $user_id, 'product_id' => $request->product_id]);

        return new FavoriteResource($favorite);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        return new FavoriteResource($favorite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id'
        ]);
        $favorite->update($request->all());
        return new FavoriteResource($favorite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);
        // Gets the user id of the requester
        $user_id = $request->user()['id'];

        // Try and delete a favorite
        try {
            // finds the first result or throws an NotFoundException
            $favoriteTobeDeleted = Favorite::where('user_id', '=', $user_id)->where('product_id', '=', $request->product_id)->firstOrFail();
            $favoriteTobeDeleted->delete();
        }catch (\Exception $e){
            return response()->json("Record not found");
        }

        return response()->json(["Record deleted"]);
    }

    /* Custom functions */
    /**
     * Get user favorites by logged-in user id
     */
    public function getUserFavorites(Request $request)
    {
        $user_id = $request->user()['id'];
        $rating = Favorite::where('user_id', '=', $user_id)->get();
        return FavoriteResource::collection($rating);
    }

    /**
     * Get a specific favorite by logged-in user id and product id
     */
    public function getUserFavorite(Request $request, int $product_id)
    {
        $user_id = $request->user()['id'];
        $rating = Favorite::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->get();
        return FavoriteResource::collection($rating);
    }
}
