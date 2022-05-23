<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    use HasFactory,Translatable;

    public $translatedAttributes = ['title'];
    protected $hidden = ['translations'];
    public $timestamps = false;

    public function meal(){
        return $this->belongsTo(Meal::class);
    }
}
