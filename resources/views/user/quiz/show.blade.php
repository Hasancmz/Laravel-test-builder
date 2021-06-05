@extends('layouts.master')
@section('content')
<div class="card mb-6">
    <div class="card-header d-flex justify-content-between">
        <h5 >{{ $quiz->title }}</h5>
        <div>
            <div>
                <small><strong>{{ $quiz->getCategory->name }}</strong></small>
            </div>
            <small>{{ $quiz->updated_at->diffForHumans() }}</small>
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $quiz->description }}</p>
    </div>
</div>
<div class="card card-header">
    <div class="mt-3">
        <h6>1# İLK SORU DENEME DENEMEDENEM QWDQW</h6>
        <div class="form-check mt-2">
            <input type="radio" id="" name="" class="form-check-input" value="answer1" required>
            <label class="form-check-label" for="">1. CEvap</label>
        </div>
        <div class="form-check">
            <input type="radio" id="" name="" class="form-check-input" value="answer2" required>
            <label class="form-check-label" for="">2. CEvap</label>
        </div>
        <div class="form-check">
            <input type="radio" id="" name="" class="form-check-input" value="answer3" required>
            <label class="form-check-label" for="">qwdqwd qwd</label>
        </div>
        <div class="form-check">
            <input type="radio" id="" name="" class="form-check-input" value="answer4" required>
            <label class="form-check-label" for="">qwd qwd qwdqw</label>
        </div>
    </div>
</div>
@endsection