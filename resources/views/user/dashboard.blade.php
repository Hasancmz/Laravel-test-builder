@extends('layouts.master')
@section('content')
    <div class="mt-12">
        <a class="btn btn-primary" href="{{ route('quiz.create') }}" class="text-light text-decoration-none">Quiz Oluştur</a>
        <a class="btn btn-warning ml-6 text-light" href="{{ route('user.myquizzes') }}" class="text-light text-decoration-none">Paylaşımlarım</a>
        @if (auth()->user()->type === 'Admin')
            <a class="btn btn-secondary ml-6" href="{{ route('quizzes.index') }}">Admin İşlemleri</a>
        @endif
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