@extends('layouts.master')
@section('content')
    @if (count($myquizzes) > 0)
        @foreach ($myquizzes as $myquiz)
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between">
                    <h5 >{{ $myquiz->getCategory->name }}</h5>
                    <small>{{ $myquiz->updated_at->diffForHumans() }}</small>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $myquiz->title }}</h5>
                    <p class="card-text">{{ $myquiz->description }}</p>
                    <a href="#" class="btn btn-primary">Soru Ekle</a>
                    <a href="{{ route('quiz.edit', $myquiz->slug) }}" class="btn btn-warning">Düzenle</a>
                    <a href="#" class="btn btn-danger">Sil</a>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-secondary">Mevcut paylaşımınız bulunmamaktadır. Quiz oluşturmayı deneyiniz.</div>
    @endif
    <div class="d-flex justify-content-center mt-8">
        {{ $myquizzes->links() }}
    </div>
    <script>
        let message = document.getElementById('message');
        if(message) {
            setTimeout(function(){
                message.remove();
            }, 3000)
        }
    </script>
@endsection