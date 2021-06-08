@extends('layouts.master')
@section('content')
        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-primary" href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-left mr-2"></i>Dashboard</a>
            <form action="" method="get">
                <div name="status">
                    <a onclick="" class="btn btn-sm btn-secondary" href="{{ route('quizzes.index') }}">Hepsi</a>
                    <a class="btn btn-sm btn-success" href="{{ route('quizzes.active') }}">Aktif</a>
                    <a class="btn btn-sm btn-warning" href="{{ route('quizzes.draft') }}">Taslak</a>
                    <a class="btn btn-sm btn-danger" href="{{ route('quizzes.passive') }}">Pasif</a>
                </div>
            </form>
        </div>
        <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th scope="col">Number</th>
                <th scope="col">Kategori</th>
                <th scope="col">Quiz</th>
                <th scope="col">Soru Sayısı</th>
                <th scope="col">Durum</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Paylaşan</th>
                <th scope="col">Zaman</th>
                <th scope="col" style="width: 110px">İşlemler</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ ($quizzes->currentpage()-1) * $quizzes->perpage() + $loop->iteration }}</td>
                        <td>{{ $quiz->getCategory->name }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->get_my_questions_count }}</td>
                        <td 
                            @if ($quiz->status === 'active') class="text-success" @endif
                            @if ($quiz->status === 'draft') class="text-warning" @endif
                            @if ($quiz->status === 'passive') class="text-danger" @endif
                            >
                            <strong>{{ $quiz->status }}</strong>
                        </td>
                        <td>{{ Str::limit($quiz->description,55) }}</td>
                        <td>{{ $quiz->getUser->name }}</td>
                        <td><small>{{ $quiz->updated_at->diffForHumans() }}</small></td>
                        <td>   
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('quizzes.show',$quiz->slug) }}" class="btn btn-sm btn-primary"><i class="fa fa-info" aria-hidden="true"></i></a>
                                <a href="{{ route('quizzes.edit',$quiz->slug) }}" class="btn btn-sm btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-8">
            {{ $quizzes->links() }}
        </div>
    {{-- <div class="d-flex justify-content-center mt-8">
      {{ $questions->getMyQuestions->links() }}
    </div> --}}

<script>
    let message = document.getElementById('message');
    if(message) {
        setTimeout(function(){
            message.remove();
        }, 3000)
    }
</script>
@endsection