@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-3 items-center">
    <a class="btn btn-sm btn-primary" href="{{ route('quizzes.index') }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('quizzes.update',$quiz->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="">Quiz Başlığı</label>
                <input type="tex" disabled name="title" class="form-control" value="{{ $quiz->title }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Quiz Açıklama</label>
                <textarea name="description" disabled class="form-control" rows="4">{{ $quiz->description }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="">Durum</label>
                <select name="status" class="form-control">
                    <option value="">Durum Seçiniz</option>
                    <option @if($quiz->status === 'active') selected @endif value="active">Active</option>
                    <option @if($quiz->status === 'draft') selected @endif value="draft">Draft</option>
                    <option @if($quiz->status === 'passive') selected @endif value="passive">Passive</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success btn-sm btn-block">Quizi Aktif Et</button>
            </div>
        </form>
    </div>
</div>
@endsection