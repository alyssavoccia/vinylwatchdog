<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VinylRecord extends Model {
    use HasFactory;

    protected $fillable = [
        'discogs_id',
        'ebay_id',
        'amazon_id',
        'title',
        'artist',
        'genre',
        'pressing',
        'year',
        'cover_image',
        'discogs_link',
        'ebay_link',
        'amazon_link',
        'lowest_price',
        'lowest_price_currency',
        'tracklist',
    ];
}