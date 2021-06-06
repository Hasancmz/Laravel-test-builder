<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'quiz_id', 'image', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer'];

    // public function getUser()
    // {
    //     return $this->hasOne('App\Models\Quiz', 'id', 'quiz_id');
    // }
}
