<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=> true,
            ]
        ];
    }
    use HasFactory;
    protected $fillable = ['file_id','user_id','title','abstract','category_id', 'resource', 'year','views', 'slug'];
    public function user(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function originalUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function file(){

        return $this->belongsTo(File::class);
    }
}
