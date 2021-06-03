@extends('layouts.master')
@section('content')
    <div class="alert alert-secondary">
        Quiz Ekleyebilmeniz için en az 5 soru gerekmektedir. Quizi paylaştığınızda incelendikten sonra eğer uygunsa paylaşımı yapılacaktır.
    </div>
    <div class="mt-12">
        <button class="btn btn-primary">
            <a href="{{ route('quiz.create') }}" class="text-light text-decoration-none">Quiz Paylaş</a>
        </button>
        <button class="btn btn-warning ml-6 text-light">
            <a href="#" class="text-light text-decoration-none">Paylaşımlarım</a>
        </button>
    </div>
@endsection