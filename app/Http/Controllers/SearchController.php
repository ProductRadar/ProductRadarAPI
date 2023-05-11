<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    /**
     * Performs a simple search
     *
     * @param string $search
     * @return AnonymousResourceCollection
     */
    public function searchProduct(string $search): AnonymousResourceCollection
    {
        $result = Product::where('name', 'LIKE', "%$search%")->get();;
        return ProductResource::collection($result);
    }
}
