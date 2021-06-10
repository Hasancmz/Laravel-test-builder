@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10">
        İstatistikler tutulcak.
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