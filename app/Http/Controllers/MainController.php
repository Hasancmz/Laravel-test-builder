<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
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
        $quizzes = Quiz::where('status', 'active')->orderBy('updated_at', 'DESC')->paginate(12);
        $categories = Category::withCount('getQuiz')->get();
        $category_count = Category::with('getQuiz')->get();
        // kategorilerin sayılarını yapamadım yapılcak

        return view('public.quizzes', [
            'quizzes' => $quizzes,
            'categories' => $categories,
            'category_count' => $category_count,
        ]);
    }

    public function quizDetail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        return view('public.quizDetail', [
            'quiz' => $quiz
        ]);
    }

    public function myquizzes()
    {
        $user = auth()->user()->id;
        $my_quizzes = User::find($user)->getMyQuizzes()->orderBy('updated_at', 'DESC')->paginate(5);
        return view('user.my-quizzes', [
            'myquizzes' => $my_quizzes,
        ]);
    }

    public function quizActive(Request $request, $slug)
    {
        Quiz::whereSlug($slug)->update($request->except(['_method', '_token']));
        return redirect()->route('user.myquizzes')->withSuccess('Quiziniz incelendikten sonra uygun görülürse aktifleştirilecektir.');
    }

    public function category($slug)
    {
        $categories = Category::withCount('getQuiz')->get();
        $category = Category::whereSlug($slug)->first();
        $quizzes = Quiz::where('category_id', $category->id)->where('status', 'active')->orderBy('updated_at', 'DESC')->paginate(12);
        $quizzes_count = Quiz::where('status', 'active')->get();
        return view('public.category', [
            'categories' => $categories,
            'quizzes' => $quizzes,
            'quizzes_count' => $quizzes_count
        ]);
    }

    public function questions($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        $questions = Quiz::whereSlug($slug)->with('getMyQuestions')->first();

        // return $questions;
        return view('user.exam.questions', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }
}
