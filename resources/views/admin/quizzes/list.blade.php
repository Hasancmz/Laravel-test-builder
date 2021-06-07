@extends('layouts.master')
@section('content')
        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-primary" href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-left mr-2"></i>Dashboard</a>
            {{-- <a class="btn btn-sm btn-warning" href="{{ route('questions.create',$quiz->slug ) }}"><i class="fa fa-plus mr-2"></i></a> --}}
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
                <th scope="col" style="width: 100px">İşlemler</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ ($quizzes->currentpage()-1) * $quizzes->perpage() + $loop->iteration }}</td>
                        <td>{{ $quiz->getCategory->name }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->get_my_questions_count }}</td>
                        <td>{{ $quiz->status }}</td>
                        <td>{{ Str::limit($quiz->description,85) }}</td>
                        <td>{{ $quiz->getUser->name }}</td>
                        <td>   
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
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

    {{-- <script>
      let message = document.getElementById('message');
      if(message) {
          setTimeout(function(){
              message.remove();
          }, 3000)
      }
  </script> --}}
@endsection