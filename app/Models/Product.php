<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'rating'
    ];

    public function user_favorites()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\Favorite',
            'product',
            'id',
            'id',
            'user'
        );
    }

    public function user_ratings()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\Rating',
            'product',
            'id',
            'id',
            'user'
        );
    }
}
