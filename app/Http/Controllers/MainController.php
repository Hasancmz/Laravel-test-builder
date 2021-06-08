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
}
