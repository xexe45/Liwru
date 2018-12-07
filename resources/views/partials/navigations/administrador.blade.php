    <li class="sub-menu">
        <a {{ \App\Helpers\Helper::setActive('administracion') }} href="javascript:;" >
            <i class="fa fa-dashboard"></i>
            <span>ADMINISTRACIÓN</span>
        </a>
        <ul class="sub">
            <li><a  href="{{ route('users.view') }}">Usuarios</a></li>
            <li><a  href="{{ route('categories.view') }}">Categorías</a></li>
            <li><a  href="{{ route('authors.view') }}">Autores</a></li>
        </ul>
    </li>
    
    @include('partials.navigations.all')