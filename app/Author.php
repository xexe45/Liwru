<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name','slug'];

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
