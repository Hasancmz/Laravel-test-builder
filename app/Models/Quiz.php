<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'category_id', 'user_id', 'slug', 'status'];
    protected $appends = ['my_rank'];

    public function getCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getMyQuestions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function my_result()
    {
        return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
    }

    public function topTen()
    {
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function getMyRankAttribute()
    {
        $rank = 0;
        $results = $this->results()->orderByDesc('point')->get();
        foreach ($results as $result) {
            $rank += 1;
            if (auth()->user()->id == $result->user_id) {
                return $rank;
            }
        }
    }
}
