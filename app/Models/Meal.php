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
    protected $hidden = ['links'];

    protected $appends = array('status');

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
