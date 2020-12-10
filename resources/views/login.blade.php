<!DOCTYPE html>
<html lang="en">
	
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ asset('theme/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/vendors/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/vendors/sweetalert2/sweetalert2.min.css') }}">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ asset('theme/css/preload.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/app.min.css') }}">
    </head>

    <body data-ma-theme="green">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Bienvenido, Inicie sesion.

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">olvidaste la contraseña?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <form id="FormLogin" method="POST" >
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" id="usuario" name="usuario" autocomplete="off" class="form-control">
                            <label>Usuario o Email</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" name="password" id="password" autocomplete="off" class="form-control">
                            <label>Contraseña</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <button type="submit" id="btn-login" class="btn btn--icon login__block__btn">
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>


            <!-- Forgot Password -->
            <div class="login__block" id="l-forget-password">
                <div class="login__block__header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Olvidaste la contraseña?

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Tiene cuenta?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <p class="mt-4">Se le enviara un email para recuperar la cuanta.</p>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control">
                        <label>Email</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <button href="index-2.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
                </div>
            </div>
        </div>
		
        <!-- Vendors -->
        <script src="{{ asset('theme/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/popper.js/popper.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- App functions and actions -->
        <script src="{{ asset('theme/js/app.min.js') }}"></script>
		<script>
			$(function(){
			  	$('body').on('submit', '#FormLogin', function(e){
                    e.preventDefault();
					$.ajax({
						url: "{{ route('login') }}",
                        method: 'post',
                        beforeSend: function() {
                            swal({
                                title: 'Validando informacion!',
                                html: '<div class="preloader pl-size-xs"><div class="spinner-layer pl-red-grey"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>',
                                showConfirmButton: false
                            });
                        },
						data: {
							username : $('#usuario').val(),
							password : $('#password').val(),
							"_token" : "{{ csrf_token() }}"
						},
						dataType: 'json',
						success: function(respuesta) {
						    if(respuesta.success){
                                swal({
                                    title: 'Iniciando session!',
                                    type: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    location.href = "{{ route('home') }}";
                                });
						    }else{
                                swal({
                                    title: 'No puede iniciar session',
                                    text: respuesta.error,
                                    type: 'warning',
                                    buttonsStyling: false,
                                    confirmButtonClass: 'btn btn-primary'
                                });
						    }
						},
						error: function() {
						    console.log("No se ha podido obtener la información");
						}
					});
				});
			});
			
		</script>
    </body>

</html>