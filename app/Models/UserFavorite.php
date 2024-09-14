<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vinyl_record_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}