<ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link orange-color" href="{{ route('admin.egresados') }}">Egresados</a>
    </li>
    <li class="nav-item">
        <a class="nav-link orange-color" href="{{ route('admin.egresado.create') }}">Agregar nuevo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link orange-color" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          Cerrar sesion
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
</ul>