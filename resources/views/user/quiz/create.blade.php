@extends('layouts.master')
@section('content')
<a class="btn btn-sm btn-primary mb-3" href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-left mr-2"></i>Dashboard</a>
<div class="card">
    <div class="card-body">
        <form action="{{ route('quiz.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="">Quiz Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{ old("title") }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Quiz Açıklama</label>
                <textarea name="description" class="form-control" rows="4">{{ old("description") }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">Durum Seçiniz</option>
                    @foreach ($categories as $category)
                        <option @if(old('category_id') === $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Oluştur</button>
            </div>
        </form>
    </div>
</div>
@endsection