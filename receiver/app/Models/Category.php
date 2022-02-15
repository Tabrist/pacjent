<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use HasFactory;

    protected $fillable = ['name'];

    public function tests() {
        return $this->belongsToMany('App\Models\Test', 'category_test', 'category_id', 'test_id');
    }

}
