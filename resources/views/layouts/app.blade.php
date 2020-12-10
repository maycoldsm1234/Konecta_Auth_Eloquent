<!DOCTYPE html>
<html lang="en">

	<head>
        <meta charset="utf-8 ">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ asset('theme/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
		<link rel="stylesheet" href="{{ asset('theme/vendors/sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/vendors/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/vendors/jquery-scrollbar/jquery.scrollbar.css') }}">

        <!-- App styles -->
        @yield('styles')
        <link rel="stylesheet" href="{{ asset('theme/css/preload.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/personal.style.css') }}">
    </head>

    <body data-ma-theme="green">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="{{ route('home') }}">Prueba Konecta</a></h1>
                </div>


                <ul class="top-nav">
                    <li class="hidden-xs-down">
                        <a href="#">{{ Auth::user()->name }} ({{ Auth::user()->roles()->first()->description }}) </a>
                    </li>
                    <li class="dropdown hidden-xs-down">
                        <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item btn-logout">Cerrar Session</a>
                        </div>
                    </li>
                </ul>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="{{ asset('theme/demo/img/profile-pics/8.jpg') }}" alt="">
                            <div>
                                <div class="user__name">{{ Auth::user()->name }}</div>
                                <div class="user__email">{{ Auth::user()->roles()->first()->description }}</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item btn-logout">Cerrar Session</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        {{ view('menus.principal') }}
                    </ul>
                </div>
            </aside>

            <section class="content">

                @yield('content')

                <footer class="footer hidden-xs-down">
                    <p>© Prueba. Todos los Derechos Reservados.</p>
                    <p>Maycol Sanchez, Desarrollador.</p>
                    <p><img src="{{ asset('img/logo.png') }}" /></p>
                </footer>
            </section>
        </main>

        <!-- Vendors -->
        <script src="{{ asset('theme/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/popper.js/popper.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>
        

        <!-- App functions and actions -->
        <script src="{{ asset('theme/js/app.min.js') }}"></script>
        <script src="{{ asset('theme/js/funcionesglobales.js') }}"></script>
		<script type="application/javascript">
			$(function(){
			  	$('body').on('click', '.btn-logout', function(){
					$.ajax({
						url: "{{ route('logout') }}",
                        type : 'POST',
						data : {
                            "_token" : "{{ csrf_token() }}"
                        },
  						dataType : 'json',
						success: function(respuesta) {
						 	location.href = "{{ route('/') }}";
						},
						error: function() {
						  console.log("No se ha podido obtener la información");
						}
					});
                });

                $('.select2-simple').select2({
                    width: '100%',
                    dropdownAutoWidth: true,
                }).on('select2:select', function(){
                    $(this).trigger('blur');
                });

                $('.select2-simpledp').each( function(){
                    var parent_id = $(this).closest('.modal').attr('id');
                    $(this).select2({
                        width: '100%',
                        dropdownParent:  $('#'+parent_id),
                    });
                }).on('select2:select', function(){
                    $(this).trigger('blur');
                });                
			});
		</script>
		@yield('script')
    </body>

</html>