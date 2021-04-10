<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class University extends Model
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
        if (ctype_upper($value[0])) {
        $this->attributes['name'] = $value;
        } else {
            $name = $value;
            $name = strtolower($name);
            $name = ucfirst($name);
            $this->attributes['name'] = $name;
        }

    }
}
