<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    CONST NO_DISPONIBLE = 0;
    CONST DISPONIBLE = 1;
    CONST INTERCAMBIADO = 2;

    protected $fillable = ["liwru_code"];

    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function getPathAttribute()
    {
        return "/images/books/{$this->picture}";
    }
}
