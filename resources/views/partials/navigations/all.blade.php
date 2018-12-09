<li class="mt">
    <a {{ \App\Helpers\Helper::setActive('home') }} href="/home">
        <i class="fa fa-dashboard"></i>
        <span>BIBLIOTECA</span>
    </a>
</li>

<li class="mt">
    <a href="/subir">
        <i class="fa fa-upload"></i>
        <span>SUBIR UN LIBRO</span>
    </a>
</li>

<li class="sub-menu">
    <a href="javascript:;" >
        <i class="fa fa-book"></i>
        <span>MIS LIBROS</span>
    </a>
    <ul class="sub">
        <li><a  href="{{ route('subidos.list') }}">Subidos</a></li>
        <li><a  href="{{ route('intercambiados.list') }}">Intercambiados</a></li>
    </ul>
</li>

<li class="mt">
    <a href="index.html">
        <i class="fa fa-bell"></i>
        <span>NOTIFICACIONES</span>
    </a>
</li>

<li class="mt">
    <a href="index.html">
        <i class="fa fa-heart"></i>
        <span>LISTA DE DESEOS</span>
    </a>
</li>

<li class="mt">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
     >
        <i class="fa fa-sign-out"></i>
         <span>{{ __("CERRAR SESIÓN") }}</span>
     </a>

     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
     </form>
    
</li>