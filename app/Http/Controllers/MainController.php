<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\ViewErrorBag;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function home()
    {
        return view('public.home');
    }

    public function quizzes()
    {
        $quizzes = Quiz::paginate(12);
        $categories = Category::withCount('getQuiz')->get();
        return view('public.quizzes', [
            'quizzes' => $quizzes,
            'categories' => $categories
        ]);
    }

    public function quizDetail($slug)
    {
        $quiz_detail = Quiz::whereSlug($slug)->first() ?? abort(404);
        return view('public.quizDetail', [
            'quiz_detail' => $quiz_detail
        ]);
    }
}
