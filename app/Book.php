<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = ['user_id', 'publisher_id','title', 'slug', 'description','cover'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    // Se desactiva 
    // public function getCoverAttribute($cover)
    // {
    //     if( !$cover || starts_with($cover, 'http') ){
    //         return $cover;
    //     }

    //     return Storage::disk('public')->url($cover);
    // }
}
