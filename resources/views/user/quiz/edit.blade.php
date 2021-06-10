@extends('layouts.master')
@section('content')
<a class="btn btn-sm btn-primary mb-3" href="{{ route('user.myquizzes') }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
<div class="card">
    <div class="card-body">
        <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="">Quiz Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
            </div>
            <div class="form-group">
                <label for="">Quiz Açıklama</label>
                <textarea name="description" class="form-control" rows="4">{{ $quiz->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">Kategori seçiniz</option>
                    @foreach ($categories as $category)
                        <option @if($category->id === $quiz->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection