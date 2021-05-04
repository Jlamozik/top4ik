<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    public $fillable =
    [
        "name",
        "password",
        "login",
    ];

    public $hidden = 
    [
        "password",
        "api_token",
    ]; 
}