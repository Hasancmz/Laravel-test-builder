<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Sayfası</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    {{-- Header --}}  
    <x-header />

    <div class="container mt-12 mb-16">
        {{-- Hata mesajı --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </div>                        
        @endif

        {{-- Başarıyla işlem yapıldı mesajı --}}
        @if (session('success'))
            <div id="message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- içerik --}}
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>