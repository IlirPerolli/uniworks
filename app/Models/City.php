<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use HasFactory;
    use HasFactory, Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=> true,
            ]
        ];
    }
    protected $fillable = [
        'name','slug'
    ];
    public function posts(){

        return $this->hasMany(Post::class);
    }
    public function setNameAttribute($value){
        $name = $value;
        $name = strtolower($name);
        $name = ucfirst($name);
        $this->attributes['name'] = $name;
    }
}
