<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'category_id', 'slug', 'status'];

    public function getCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
