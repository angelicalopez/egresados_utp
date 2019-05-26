<ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link orange-color" href="{{ route('superuser.admin') }}">Administradores</a>
    </li>
    <li class="nav-item">
        <a class="nav-link orange-color" href="{{ route('superuser.admin.crear') }}">Agregar nuevo</a>
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