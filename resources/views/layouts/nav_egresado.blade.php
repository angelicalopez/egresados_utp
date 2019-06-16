<nav class="navbar fixed-top navbar-expand-lg navbar-light text-white bg-orange navbar-egresado">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('egresado.profile', $user->id) }}">Perfil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('egresado.noticias') }}">Noticias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#" tabindex="-1" aria-disabled="true">Amigos</a>
        </li>
        </ul>
        <span class="navbar-text">
            <a class="nav-link text-white" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Cerrar sesion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </span>
    </div>
</nav>