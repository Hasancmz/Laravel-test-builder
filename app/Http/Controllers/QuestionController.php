<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;

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
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
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
    public function store(QuestionCreateRequest $request, $slug)
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
        return "SELAMmm";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $quiz = Quiz::whereSlug($slug)->first() ?? abort(404);
        $question = Question::whereId($id)->first() ?? abort(404);

        if (auth()->user()->id === $quiz->user_id && $quiz->id === $question->quiz_id) {
            return view('user.question.edit', [
                'quiz' => $quiz,
                'question' => $question
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
    public function update(QuestionUpdateRequest $request, $slug, $id)
    {
        if ($request->hasfile('image')) {
            $fileName = Str::slug($request->question) . '-' . time() . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
        }
        Question::whereId($id)->first()->update($request->post());
        return redirect()->route('questions.index', $slug)->withSuccess('Soru Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        Question::find($id)->delete();
        return redirect()->route('questions.index', $slug)->withSuccess('Soru Başarıyla Silindi');
    }
}
