<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with('getCategory', 'getUser')->withCount('getMyQuestions')->orderBy('created_at', 'ASC')->paginate(10);
        $actives = Quiz::where('status', 'active')->with('getCategory', 'getUser')->withCount('getMyQuestions')->orderBy('created_at', 'ASC')->paginate(10);

        // if (request()->get('status')) {
        //     $quizzes = $quizzes->where('status', request()->get('status'));
        // }

        return view('admin.quizzes.list', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('admin.quizzes.show', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        return view('admin.quizzes.edit', [
            'quiz' => $quiz
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        Quiz::whereSlug($slug)->update($request->except(['_method', '_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quizin Durumu Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
