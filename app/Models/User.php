<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username',
                'onUpdate'=> true,
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','gender','username','slug','university_id','city_id','about','linkedin','github','website', 'email', 'password','photo_id','username_changed'
    ];
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function university(){
        return $this->belongsTo(University::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function bookmark()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')->withTimestamps()->withPivot('user_id', 'post_id');
    }
    public function isAdmin(){
        if ($this->role->name == "administrator"){
            return true;
        }
        return false;
    }
    public function setNameAttribute($value){
        $name = $value;
        $name = strtolower($name);
        $name = ucfirst($name);
        $this->attributes['name'] = $name;
    }
    public function setSurnameAttribute($value){
    if ($value != null) {
        $surname = $value;
        $surname = strtolower($surname);
        $surname = ucfirst($surname);
        $this->attributes['surname'] = $surname;
    }
    else{ $this->attributes['surname'] = $value;}


    }
    public function setUsernameAttribute($value){
        if ($value != null) {
            $username = strtolower($value);
            $this->attributes['username'] = $username;
        }
        else{$this->attributes['username'] = $value;}
    }
    public function setSlugAttribute($value){
        if ($value != null) {
            $slug = strtolower($value);
            $this->attributes['slug'] = $slug;
        }
        else{$this->attributes['slug'] = $value;}
    }
    public function setEmailAttribute($value){
        if ($value != null) {
            $email = strtolower($value);
            $this->attributes['email'] = $email;
        }
    else{$this->attributes['email'] = $value;}
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
