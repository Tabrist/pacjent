<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model {

    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'category_test', 'test_id', 'category_id');
    }

}
