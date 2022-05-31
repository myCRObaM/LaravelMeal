<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title'];
    protected $hidden = ['translations', 'pivot'];
    public $timestamps = false;

    public function meal(){
        return $this->belongsToMany(Meal::class, "meals_tags");
    }
}
