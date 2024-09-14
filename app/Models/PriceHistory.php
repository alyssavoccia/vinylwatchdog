<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model {
    // Use table price_history
    protected $table = 'price_history';
    
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'vinyl_record_id',
        'source',
        'price',
        'currency',
        'created_at'
    ];

    public function vinylRecord() {
        return $this->belongsTo(VinylRecord::class);
    }
}