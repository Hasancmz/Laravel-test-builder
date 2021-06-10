@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-3 items-center">
    <a class="btn btn-sm btn-primary" href="{{ route('quiz.detail',$quiz->slug) }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
</div>
{{-- <div class="card mb-6">
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
</div> --}}
<div class="card card-header">
    <form action="{{ route('user.result', $quiz->slug) }}" method="POST">
        @csrf
        @foreach ($questions->getMyQuestions as $question)    
            <div class="mt-2 mb-2">
                <h6>{{ $loop->iteration }}#  {{ $question->question }}</h6>
                <div class="form-check mt-2">
                    <input type="radio" id="" name="{{ $question->id }}" class="form-check-input" value="answer1" required>
                    <label class="form-check-label" for="">{{ $question->answer1 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="" name="{{ $question->id }}" class="form-check-input" value="answer2" required>
                    <label class="form-check-label" for="">{{ $question->answer2 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="" name="{{ $question->id }}" class="form-check-input" value="answer3" required>
                    <label class="form-check-label" for="">{{ $question->answer3 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="" name="{{ $question->id }}" class="form-check-input" value="answer4" required>
                    <label class="form-check-label" for="">{{ $question->answer4 }}</label>
                </div>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
        <button class="form-control btn btn-success mt-10 mb-3">Sınavı Bitir</button>
    </form>
</div>
@endsection