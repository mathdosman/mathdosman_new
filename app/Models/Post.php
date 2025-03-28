<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable =[
        'author_id',
        'category',
        'title',
        'slug',
        'content',
        'views',
        'featured_image',
        'tags',
        'meta_keywords',
        'meta_description',
        'visibility',
        'is_notified'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function author(){
        return $this->hasOne(User::class,'id','author_id');
    }

    public function post_category(){
        return $this->hasOne(Category::class,'id','category');
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('title','like',$term);
        });
    }
}