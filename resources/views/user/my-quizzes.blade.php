@extends('layouts.master')
@section('content')
    @if (count($myquizzes) > 0)
        @foreach ($myquizzes as $myquiz)
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between">
                    <h5 >{{ $myquiz->getCategory->name }}</h5>
                    <div class="btn btn-sm disabled btn-secondary">Quiz Pasif</div>
                </div>
                <a href="{{ route('quiz.show',$myquiz->slug) }}" class="text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">{{ $myquiz->title }}</h5>
                        <p class="card-text">{{ $myquiz->description }}</p>
                        <div class="d-flex justify-content-between mt-3">
                            <small>{{ $myquiz->updated_at->diffForHumans() }}</small>
                            <form class="" action="{{ route('quiz.destroy', $myquiz->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('questions.index',$myquiz->slug) }}" class="btn btn-primary">Sorular</a>
                                <a href="{{ route('quiz.edit', $myquiz->slug) }}" class="btn btn-warning">Düzenle</a>
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form> 
                        </div>
                    </div>
                </a>
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