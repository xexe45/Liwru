<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug' ,'email','birthday','password','phone','role_id','picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pathAttachment(){
        return "/images/users/".$this->picture;
    }

    public static function navigation(){
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
