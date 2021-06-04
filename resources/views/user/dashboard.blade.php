@extends('layouts.master')
@section('content')
    <div class="mt-12">
        <button class="btn btn-primary">
            <a id="" href="{{ route('quiz.create') }}" class="text-light text-decoration-none">Quiz Oluştur</a>
        </button>
        <button class="btn btn-warning ml-6 text-light">
            <a href="{{ route('user.myquizzes') }}" class="text-light text-decoration-none">Paylaşımlarım</a>
        </button>
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