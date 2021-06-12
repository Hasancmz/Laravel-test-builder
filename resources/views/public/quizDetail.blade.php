@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    @if($quiz->my_result)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sıralama
                            <span class="text-primary">{{ $quiz->my_rank }}#</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puan
                            <span class="">{{ $result->point }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Doğru/Yanlış Sayısı
                            <div>
                                <span class="text-success">{{ $result->correct }} Doğru</span>
                                <span class="text-danger">{{ $result->wrong }} Yanlış</span>
                            </div>
                        </li>
                    
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Soru Sayısı
                            <span class="">{{ count($quiz->getMyQuestions) }}</span>
                        </li>
                    
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Katılımcı Sayısı
                            <span class="">{{ count($quiz->results) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ortalama Puan
                            <span class="">{{ round($quiz->results->avg('point'),2) }}</span>
                        </li>
                    @endif
                </ul>
                @if(count($quiz->topTen) > 0)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title">İlk 10</h5>
                            <ul class="list-group">
                                @foreach ($quiz->topTen as $rank)    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="float-left">{{ $loop->iteration }}#</h4>
                                            {{-- <img class="h-9 w-9 rounded-full" src="">  --}}
                                        </div>
                                        <span @if(auth()->user()->id == $rank->user_id) class='text-primary text-xl' @endif>{{ $rank->user->name }}</span>
                                        <h5 class="">{{ $rank->point }}</h5>
                                    </li>    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @if (count($quiz->topTen) > 0)
                <div class="col-md-8">
                    <li class="list-group-item list-group-item-secondary mb-6">{{ $quiz->title }}</li>
                    <p class="card-text mb-12">
                        {{ $quiz->description }}
                    </p>  
                    @if ($quiz->my_result)
                        <a href="{{ route('user.questions',$quiz->slug) }}" class="list-group btn btn-warning btn-block btn-sm">Quizi Görüntüle</a>   
                    @else 
                        <a href="{{ route('user.questions',$quiz->slug) }}" class="list-group btn btn-primary btn-block btn-sm">Quize Katıl</a>
                    @endif
                </div>     
            @else
                <div class="col-md-12">
                    <li class="list-group-item list-group-item-secondary mb-6">{{ $quiz->title }}</li>
                    <p class="card-text mb-12">
                        {{ $quiz->description }}
                    </p>  
                    @if ($quiz->my_result)
                    <a href="{{ route('user.questions',$quiz->slug) }}" class="list-group btn btn-warning btn-block btn-sm">Quizi Görüntüle</a>   
                    @else 
                        <a href="{{ route('user.questions',$quiz->slug) }}" class="list-group btn btn-primary btn-block btn-sm">Quize Katıl</a>
                    @endif
                </div>     
            @endif  
            
        </div>
    </div>
</div>
@endsection