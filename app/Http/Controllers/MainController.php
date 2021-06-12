<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Support\ViewErrorBag;

class MainController extends Controller
{
    public function dashboard()
    {
        $id = auth()->user()->id;
        $results = User::whereId($id)->with('results.quiz')->first();

        return view('user.dashboard', [
            'results' => $results
        ]);
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

        return view('public.quizzes', [
            'quizzes' => $quizzes,
            'categories' => $categories,
            'category_count' => $category_count,
        ]);
    }

    public function quizDetail($slug)
    {

        $quiz = Quiz::whereSlug($slug)->with('getMyQuestions', 'results', 'my_result', 'topTen.user')->first() ?? abort(404);
        $results = User::whereId(auth()->user()->id)->with('results')->first();
        $result = $results->results->where('quiz_id', $quiz->id)->first();
        // dd($quiz);
        return view('public.quizDetail', [
            'quiz' => $quiz,
            'result' => $result
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

        if ($quiz->user_id === auth()->user()->id) {
            return redirect()->route('quiz.detail', $quiz->slug);
        };

        if ($quiz->my_result) {
            return view('user.exam.my_result', [
                'quiz' => $quiz,
                'questions' => $questions
            ]);
        };
        // return $questions;
        return view('user.exam.questions', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    public function result(Request $request, $slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('getMyQuestions')->first() ?? abort(404);
        $correct = 0;

        if ($quiz->my_result) {
            return redirect()->route('quiz.detail', $quiz->slug)->withSuccess('Başarıyla Quizi Bitirdin. Puanın : ' . $quiz->my_result->point);
        }

        foreach ($quiz->getMyQuestions as $question) {
            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer' => $request->post($question->id)
            ]);

            if ($question->correct_answer === $request->post($question->id)) {
                $correct += 1;
            }
        }

        $point = round((100 / count($quiz->getMyQuestions)) * $correct);
        $wrong = count($quiz->getMyQuestions) - $correct;

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => $point,
            'correct' => $correct,
            'wrong' => $wrong
        ]);

        return redirect()->route('quiz.detail', $quiz->slug)->withSuccess('Başarıyla Quizi Bitirdin. Puanın : ' . $point);
    }
}
