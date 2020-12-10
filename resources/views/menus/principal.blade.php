<li>
    <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Inicio</a>
    <a href="{{ route('clientes') }}"><i class="zmdi zmdi-accounts-alt"></i> Clientes</a>
    @if(Auth::user()->isAdmin())
    <a href="{{ route('usuarios') }}"><i class="zmdi zmdi-account-circle"></i> Usuarios</a>
    @endif
</li>