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
    protected $fillable = ['file_id','title','abstract','category_id', 'resource', 'views', 'slug'];
    public function user(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function category(){

        return $this->belongsTo(Category::class);
    }
}
