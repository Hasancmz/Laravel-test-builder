<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        //questions sorgusunda ilişkili veriyi her zamanki yöntem ile çekemedim daha sonra bak.
        $questions = Quiz::whereSlug($slug)->with('getMyQuestions')->first();
        // return $questions;
        return view('user.question.list', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $quiz = Quiz::whereSlug($slug)->first();
        return view('user.question.create', [
            'quiz' => $quiz
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        if ($request->hasfile('image')) {
            $fileName = Str::slug($request->question) . '-' . time() . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
        }

        $quiz_id = Quiz::whereSlug($slug)->first();
        $request['quiz_id'] = $quiz_id->id;
        // return $request->all();
        Question::create($request->post());
        return redirect()->route('questions.index', $slug)->withSuccess('Sorunuz başarıyla oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
