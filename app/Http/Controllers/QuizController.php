<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.quiz.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        $slug = Str::slug($request->title);
        $user_id = auth()->user()->id;

        $request['slug'] = $slug;
        $request['user_id'] = $user_id;

        Quiz::create($request->all());
        return redirect()->route('user.dashboard')->withSuccess('Quiziniz Başarıyla oluşturuldu. Sorularınızı eklemeyi unutmayınız. Soruları ekledikten sonra gerekli incelemeler yapılıp uygunsa quiziniz paylaşılacaktır. Aşağıdaki paylaşımlarım butonuna tıklayarak quizinize sorularınızı ekleyebilirsiniz.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        $questions = Quiz::whereSlug($slug)->with('getMyQuestions')->first();

        if (auth()->user()->id === $quiz->user_id) {
            return view('user.quiz.show', [
                'quiz' => $quiz,
                'questions' => $questions
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::whereSlug($id)->first() ?? abort(404);
        $categories = Category::all();
        if (auth()->user()->id === $quiz->user_id) {
            return view('user.quiz.edit', [
                'categories' => $categories,
                'quiz' => $quiz
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        Quiz::find($id)->update($request->except(['_method', '_token']));
        return redirect()->route('user.myquizzes')->withSuccess('Quiz Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id)->delete() ?? abort(404);
        return redirect()->route('user.myquizzes')->withSuccess('Quiz Başarıyla Silindi');
    }
}
