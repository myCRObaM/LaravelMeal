<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $hidden = ['links', 'category_id', 'translations', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = array('status');

    public function category() {
        return $this->hasOne(Category::class, "id", "category_id");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "meals_tags");
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, "meals_ingredients");
    }

    protected function getStatusAttribute() {
        if ($this->deleted_at != null) {
            return 'deleted';
        }
        $createdAtDate = new \DateTime($this->created_at);
        $updatedAtDate = new \DateTime($this->updated_at);

        if ($createdAtDate != $updatedAtDate) {
            return 'updated';
        }
        return 'created';
    }
}
