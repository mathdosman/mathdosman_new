<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSosialLink extends Model
{
    protected $fillable = [
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'twitter_url',
    ];
}