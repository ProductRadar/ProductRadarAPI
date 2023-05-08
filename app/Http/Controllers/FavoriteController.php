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
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id'
        ]);

        Favorite::create($request->all());

        return new FavoriteResource($request);
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
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return null;
    }

    /* Custom functions */
    /**
     * Get user ratings by logged-in user id
     */
    public function getUserFavorites(Request $request)
    {
        $user_id = $request->user()['id'];
        $rating = Favorite::where('user_id', '=', $user_id)->get();
        return FavoriteResource::collection($rating);
    }

    /**
     * Get a specific rating by logged-in user id and product id
     */
    public function getUserFavorite(Request $request, int $product_id)
    {
        $user_id = $request->user()['id'];
        $rating = Favorite::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->get();
        return FavoriteResource::collection($rating);
    }
}
