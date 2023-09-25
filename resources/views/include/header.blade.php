<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Salir</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Ingresar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('registration')}}">Registrar</a>
          </li>
        @endauth
      </ul>
      <span class="navbar-text">
        @auth
          <a class="nav-link" href="{{route('edit')}}">{{auth()->user()->name}}</a>
        @endauth
      </span>
    </div>
  </div>
</nav>