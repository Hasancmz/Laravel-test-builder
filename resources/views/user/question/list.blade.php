@extends('layouts.master')
@section('content')
    
        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-primary" href="{{ route('user.myquizzes') }}"><i class="fa fa-arrow-left mr-2"></i>Quizlere Dön</a>
            <a class="btn btn-sm btn-success" href="{{ route('questions.create',$quiz->slug ) }}"><i class="fa fa-plus mr-2"></i>Soru ekle</a>
        </div>
        @if(count($questions->getMyQuestions) > 0)
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th scope="col">Soru</th>
                <th scope="col">Fotoğraf</th>
                <th scope="col">1.Cevap</th>
                <th scope="col">2.Cevap</th>
                <th scope="col">3.Cevap</th>
                <th scope="col">4.Cevap</th>
                <th scope="col">Doğru Cevap</th>
                <th scope="col" style="width: 100px">İşlemler</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions->getMyQuestions as $question)
                <tr>
                  <td scope="row">{{ $question->question }}</td>
                  <td>
                    @if ($question->image)
                      <a href="{{ asset($question->image) }}" class="btn btn-sm btn-secondary" target="_blank">Görüntüle</a>
                    @endif
                  </td>
                  <td>{{ $question->answer1 }}</td>
                  <td>{{ $question->answer2 }}</td>
                  <td>{{ $question->answer3 }}</td>
                  <td>{{ $question->answer4 }}</td>
                  <td class="text-success">{{ $question->correct_answer }}</td>
                  <td>   
                      <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                      <button type="submit" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
              @endforeach    
            </tbody>
          </table>
        @else
          <div class="alert alert-warning mt-10">
              Henüz hiç soru eklenmemiş. Soru ekle butonuna basarak sorunuzu ekleyebilirsiniz.
          </div>
        @endif
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