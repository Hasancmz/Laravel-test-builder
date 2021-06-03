@extends('layouts.master')
@section('content')
<div class="row">
    <div class="list-group col-md-9">
        @foreach ($quizzes as $quiz)
            <a href="{{ route('quiz.detail',$quiz->slug) }}" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $quiz->name }}</h5>
                <small>{{ $quiz->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ Str::limit($quiz->description,180) }}</p>
                <small>{{ $quiz->getCategory->name }}</small>
            </a>
        @endforeach
    </div>
    <div class="col-md-3">
        <ul class="list-group">
            @foreach ($categories as $category)
                <li>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                        {{ $category->name }}
                        <span class="badge bg-secondary rounded-pill">{{ $category->get_quiz_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="d-flex justify-content-center mt-8">
    {{ $quizzes->links() }}
</div>
@endsection