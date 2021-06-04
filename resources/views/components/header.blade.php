<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('public.home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('public.quizzes') }}">Quizler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.dashboard') }}" tabindex="-1" aria-disabled="true">Dashboard</a>
          </li>
        </ul>
        @if (Route::has('login'))
            <div>
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Deneme</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <li><a class="dropdown-item" 
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                        >Log out
                                    </a>
                                </li>
                            </form>
                        </ul>
                    </li>
                </ul>
            @else
                <button type="button" class="btn btn-primary"><a class="text-light text-decoration-none" href="/login">Login</a></button>
                @if (Route::has('register'))
                    <button type="button" class="btn btn-primary ml-4"><a class="text-light text-decoration-none" href="/register">Register</a></button>
                @endif
            @endauth
            </div>
        @endif
      </div>
    </div>
</nav>