<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'publisher',
        'author',
        'cover_photo',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'borrowed_by',
    ];

    public function borrowedByUser()
    {
        return $this->belongsTo(User::class, 'borrowed_by', 'id');
    }
}
