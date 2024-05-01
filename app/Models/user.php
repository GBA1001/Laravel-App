<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Address;

class user extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $guarded=[];
    protected $table = 'user';
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }

    public function roles()
    {
        return $this->hasMany(Roles::class, 'user_id');
    }
   
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
   
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

}

