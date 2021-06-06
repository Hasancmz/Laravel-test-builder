@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div>
            <a class="btn btn-sm btn-primary" href="{{ route('questions.index',$quiz->slug) }}"><i class="fa fa-arrow-left mr-2"></i>Sorular</a>
        </div>
        <form class="mt-3" action="{{ route('questions.store', $quiz->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Soru</label>
                <textarea name="question" class="form-control" rows="4">{{ old("question") }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="">Resim</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">1. Cevap</label>
                        <textarea name="answer1" class="form-control" rows="2">{{ old("answer1") }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">2. Cevap</label>
                        <textarea name="answer2" class="form-control" rows="2">{{ old("answer2") }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">3. Cevap</label>
                        <textarea name="answer3" class="form-control" rows="2">{{ old("answer3") }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">4. Cevap</label>
                        <textarea name="answer4" class="form-control" rows="2">{{ old("answer4") }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="">Doğru Cevap</label>
                <select name="correct_answer" class="form-control">
                    <option value="">Doğru Cevabı Seçiniz</option>
                    <option @if(old('correct_answer') === 'answer1') selected  @endif value="answer1">1. Cevap</option>
                    <option @if(old('correct_answer') === 'answer2') selected  @endif value="answer2">2. Cevap</option>
                    <option @if(old('correct_answer') === 'answer3') selected  @endif value="answer3">3. Cevap</option>
                    <option @if(old('correct_answer') === 'answer4') selected  @endif value="answer4">4. Cevap</option>
                </select>
            </div>
            <div class="form-group mt-6">
                <button type="submit" class="btn btn-success btn-sm btn-block">Soru Oluştur</button>
            </div>
        </form>
    </div>
</div>
@endsection