@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10">
        @if (count($results->results) > 0) 
        <h4 class="mb-3 text-secondary">Katılmış olduğum Quizler</h4>
            @foreach ($results->results as $result)
                <div class="card bg-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <div>Puan: {{ $result->point }}</div>
                        <div>Sıralama: #{{ $result->quiz->my_rank }}</div>
                    </div>
                    <a class="text-decoration-none text-dark" href="{{ route('quiz.detail',$result->quiz->slug) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $result->quiz->title }}</h5>
                            <p class="card-text">{{ Str::limit($result->quiz->description, 200) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="alert alert-secondary">Katılmış Olduğunuz Quiz Bulunmamaktadır</div>
        @endif
    </div>
    <div class="col-md-2 mt-12">
        <a class="d-block btn btn-primary btn-sm" href="{{ route('quiz.create') }}" class="text-light text-decoration-none">Quiz Oluştur</a>
        <a class="d-block btn btn-warning btn-sm text-light mt-2 mb-2" href="{{ route('user.myquizzes') }}" class="text-light text-decoration-none">Paylaşımlarım</a>
        @if (auth()->user()->type === 'Admin')
            <a class="d-block btn btn-secondary btn-sm" href="{{ route('quizzes.index') }}">Admin İşlemleri</a>
        @endif
    </div>
</div>

    <script>
        let message = document.getElementById('message');
        if(message) {
            setTimeout(function(){
                message.remove();
            }, 15000)
        }
    </script>
@endsection