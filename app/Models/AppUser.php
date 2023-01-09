<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

    protected $fillable = ['firstName','lastName','email'];
    public function post(){
        return $this->hasMany(Post::class);
    }
}
