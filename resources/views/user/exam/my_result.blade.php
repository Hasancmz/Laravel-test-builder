@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-3 items-center">
    <a class="btn btn-sm btn-primary" href="{{ route('quiz.detail',$quiz->slug) }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <span class="text-center mb-3 form-control"><h5>Quizden Almış Olduğunuz Puan : {{ $quiz->my_result->point }}</h5></span>
        </div>
        <div class="alert alert-warning">
            <i class="fa fa-square"></i> İşaretlediğin Şık <br>
            <i class="fa fa-check text-success"></i> Doğru Cevap <br>
            <i class="fa fa-times text-danger"></i> Yanlış Cevap
        </div>

       
            
            @foreach ($quiz->getMyQuestions as $question)  
                @if ($question->correct_answer == $question->my_answer->answer)
                    <i class="fa fa-check text-success"></i>
                @else
                    <i class="fa fa-times text-danger"></i>
                @endif
                
                <strong>#{{ $loop->iteration }}</strong>
                <span>{{ $question->question }}</span>
                <div>
                    <small>Bu soruya <strong>%{{ $question->true_percent }}</strong> oranında doğru cevap verildi.</small>
                </div> 
                @if($question->image)
                    <img src="{{ asset($question->image) }}" class="img-responsive" style="width: 50%" >
                @endif
                <div class="form-check mt-2">
                    @if('answer1' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif ('answer1' == $question->my_answer->answer)
                        <i class="fa fa-square"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{ $question->id }}1">{{ $question->answer1 }}</label>
                </div>
                <div class="form-check">
                    @if('answer2' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif ('answer2' == $question->my_answer->answer)
                        <i class="fa fa-square"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{ $question->id }}2">{{ $question->answer2 }}</label>
                </div>
                <div class="form-check">
                    @if('answer3' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif ('answer3' == $question->my_answer->answer)
                        <i class="fa fa-square"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{ $question->id }}3">{{ $question->answer3 }}</label>
                </div>
                <div class="form-check">
                    @if('answer4' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif ('answer4' == $question->my_answer->answer)
                        <i class="fa fa-square"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{ $question->id }}4">{{ $question->answer4 }}</label>
                </div>
                @if(!$loop->last)
                <hr>
                @endif
            @endforeach
        
    </div>
</div>
@endsection