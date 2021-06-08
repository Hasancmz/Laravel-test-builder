<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class StatuController extends Controller
{
    public function active()
    {
        $quizzes = Quiz::where('status', 'active')->with('getCategory', 'getUser')->withCount('getMyQuestions')->orderBy('created_at', 'ASC')->paginate(10);

        return view('admin.quizzes.list', [
            'quizzes' => $quizzes,
        ]);
    }
    public function draft()
    {
        $quizzes = Quiz::where('status', 'draft')->with('getCategory', 'getUser')->withCount('getMyQuestions')->orderBy('created_at', 'ASC')->paginate(10);

        return view('admin.quizzes.list', [
            'quizzes' => $quizzes,
        ]);
    }
    public function passive()
    {
        $quizzes = Quiz::where('status', 'passive')->with('getCategory', 'getUser')->withCount('getMyQuestions')->orderBy('created_at', 'ASC')->paginate(10);

        return view('admin.quizzes.list', [
            'quizzes' => $quizzes,
        ]);
    }
}
