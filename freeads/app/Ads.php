<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Ads extends Model
{
        protected $fillable = [
        'title', 'description', 'filename', 'price'
    ];
}