<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'site_title',
        'site_email',
        'site_phone',
        'site_meta_keyword',
        'site_meta_description',
        'site_logo',
        'site_favicon',
    ];
}
