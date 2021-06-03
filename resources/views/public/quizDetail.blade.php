@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sıralama
                            <span class="">#</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puan
                            <span class="">55</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Doğru/Yanlış Sayısı
                            <div>
                                <span class="">10 Doğru</span>
                                <span class="">3 Yanlış</span>
                            </div>
                        </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Soru Sayısı
                        <span class="">9</span>
                    </li>
                    
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Katılımcı Sayısı
                            <span class="">27</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ortalama Puan
                            <span class="">75</span>
                        </li>
                    
                  </ul>
                  
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">İlk 10</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="float-left"></h4>
                                        <img class="h-9 w-9 rounded-full" src=""> 
                                    </div>
                                    <span>İsim</span>
                                    <h5 class="">Puan</h5>
                                </li>    
                            </ul>
                        </div>
                    </div>
                  
            </div>  
            <div class="col-md-8">
                <li class="list-group-item list-group-item-secondary mb-6">{{ $quiz_detail->name }}</li>
                <p class="card-text">
                    {{ $quiz_detail->description }}
                </p>  
                <a href="" class="btn btn-warning btn-block btn-sm">Quizi Görüntüle</a>    
                <a href="" class="btn btn-primary btn-block btn-sm">Quize Katıl</a>
            </div>     
        </div>
    </div>
</div>
@endsection