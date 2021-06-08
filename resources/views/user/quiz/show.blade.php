@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-3 items-center">
    <a class="btn btn-sm btn-primary" href="{{ route('user.myquizzes') }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
    @if ($quiz->status === 'passive')
        @if (count($questions->getMyQuestions) < 5)
            <div class="alert alert-danger">Quizi aktifleştirebilmeniz için en az 5 soru eklemelisiniz.</div>
        @else
            <form action="{{ route('quiz.active', $quiz->slug) }}" method="GET">
                <input type="hidden" name="status" value="draft">
                <button type="submit" class="btn btn-success">Quizi Aktif Et</button>
            </form>
        @endif
        <a class="btn btn-sm btn-warning" href="{{ route('questions.create',$quiz->slug ) }}"><i class="fa fa-plus mr-2"></i>Soru ekle</a>
    @endif
</div>
<div class="card mb-6">
    <div class="card-header d-flex justify-content-between">
        <h5 >{{ $quiz->title }}</h5>
        <div>
            <div>
                <small><strong>{{ $quiz->getCategory->name }}</strong></small>
            </div>
            <small>{{ $quiz->updated_at->diffForHumans() }}</small>
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $quiz->description }}</p>
    </div>
</div>
@if (count($questions->getMyQuestions) > 0)
    <div class="card card-header">
        @foreach ($questions->getMyQuestions as $question)    
            <div class="mt-2 mb-2">
                <h6>{{ $loop->iteration }}#  {{ $question->question }}</h6>
                <div class="form-check mt-2">
                    <input type="radio" @if($question->correct_answer === 'answer1') checked @else disabled @endif id="" name="{{ $question->id }}" class="form-check-input" value="answer1" required>
                    <label class="form-check-label" for="">{{ $question->answer1 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" @if($question->correct_answer === 'answer2') checked @else disabled @endif id="" name="{{ $question->id }}" class="form-check-input" value="answer2" required>
                    <label class="form-check-label" for="">{{ $question->answer2 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" @if($question->correct_answer === 'answer3') checked @else disabled @endif id="" name="{{ $question->id }}" class="form-check-input" value="answer3" required>
                    <label class="form-check-label" for="">{{ $question->answer3 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" @if($question->correct_answer === 'answer4') checked @else disabled @endif id="" name="{{ $question->id }}" class="form-check-input" value="answer4" required>
                    <label class="form-check-label" for="">{{ $question->answer4 }}</label>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning mt-10">
        Henüz hiç soru eklenmemiş. Soru ekle butonuna basarak sorunuzu ekleyebilirsiniz.
    </div>
@endif
@endsection