@extends('layout')

@section('content')
	<div class="row">
		<button id="btn-usuarionuevo" type="button" class="btn btn-primary btn--raised" data-toggle="modal" data-target="#modal-usuario">Nuevo usuario</button>
	</div>
    <div class="table-responsive">
    	<table id="tabla-usuarios" class="table table-bordered">
        	<thead class="thead-default">
            	<tr align="center">
                	<th>Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                </tr>
           	</thead>
            <tfoot>
				<tr align="center">
                	<th>Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                </tr>
			</tfoot>
			<tbody>
				@forelse ($users as $user)
					<tr>
						<td align="center">{{ $user->username }}</td>
						<td align="center">{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td align="center">{{ $user->description }}</td>
						<td align="center">
							<div class="btn-group btn-group-sm mr-1">
								<button type="button" class="btn btn-warning btn-usuarioeditar" data-toggle="modal" data-target="#modal-usuario" data-user='{{ json_encode($user) }}'>
									<i class="zmdi zmdi-edit zmdi-hc-fw"></i>
								</button>
								<button type="button" class="btn btn-danger btn-usuarioeliminar" data-id_user="{{ $user->id }}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></button>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" align="center">No Hay datos en la Tabla</td>
					</tr>
				@endforelse
			</tbody>
        </table>
   	</div>

	<div class="modal fade" id="modal-usuario" tabindex="-1">
    	<div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title pull-left">Crear usuario</h5>
                </div>
                <div class="modal-body">
					<form id="FormUsuario">
						@csrf
						<input id="Accion_usuario" type="hidden" value="nuevo" >
						<input type="hidden" id="id_usuario" name="id_usuario"  value="" >
                    	<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Nombre</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Usuario</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="text" id="username" name="username" class="form-control" placeholder="Usuario" required>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Email</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                                    <i class="form-group__bar"></i>
                                </div>

                            </div>
                       	</div>
						<div class="row">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Perfil</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
									<select id="role" name="role" class="form-control" required>
										<option value="" selected>--Seleccione--</td>
										@foreach ($roles as $role)
											<option value="{{ $role->name }}">{{ $role->description }}</td>
										@endforeach
									</select>
                                </div>

                            </div>
                       	</div>
						<div class="row password">
                        	<label class="col-sm-4 col-form-label" style="text-align:right">Contraseña</label>
                            <div class="col-sm-6">
                            	<div class="form-group">
                                	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                                    <i class="form-group__bar"></i>
                                </div>

                            </div>
                       	</div>
					</form>
                </div>
                <div class="modal-footer">
					<button id="Btn-GuardarUsuario" type="button" class="btn btn-link">Guardar</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('src/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/vendors/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('src/vendors/datatables-buttons/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('src/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
	<script type="application/javascript">
		$(function(){
			$('#tabla-usuarios').DataTable();
			
			$('#btn-usuarionuevo').on('click', function(){
				$('#modal-usuario .modal-title').html('Crear usuario');
				$('#modal-usuario .password').show();
				$('#modal-usuario #username').prop('readonly', false);
				$('#Accion_usuario').val('nuevo');
			});
			
			$('.btn-usuarioeditar').on('click', function(){
				var user = $(this).data('user');
				$('#modal-usuario .modal-title').html('Editar usuario');
				$('#modal-usuario .password').hide();
				$('#modal-usuario #username').prop('readonly', true);
				$('#Accion_usuario').val('editar');
				$('#username').val(user.username);
				$('#id_usuario').val(user.id);
				$('#name').val(user.name);
				$('#email').val(user.email);
				$('#role').val(user.rol_name);
			});
			
			$('.btn-usuarioeliminar').click(function(){
				var id_user = $(this).data('id_user');
                swal({
                    title: 'Eliminar Usuario!',
                    text: 'Esta  seguro que desea eliminar el usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonClass: 'btn btn-secondary',
					cancelButtonText: 'No'
                }).then((result) => {
  					if (result.value) {
						$.ajax({
							url:  "{{ route('usuarios/eliminar') }}",
							data : {
								id_usuario : id_user,
								"_token" : "{{ csrf_token() }}",
							},
							type: 'POST',
							dataType : 'json',
							headers: {'Authorization': 'Bearer '+localStorage.getItem("token")},
							success: function(respuesta) {
								swal({
									title: 'Usuario eliminado',
									type: 'success',
									buttonsStyling: false,
									confirmButtonClass: 'btn btn-primary'
								});
								location.reload(true);
							},
							error: function() {
							  console.log("No se ha podido obtener la información");
							}
						});
					}
                    
                });
            });
			
			$('#Btn-GuardarUsuario').on('click', function(){
				if($('#Accion_usuario').val() == 'nuevo'){
					var user_url = "{{ route('usuarios/registrar') }}";
				}else{
					var user_url = "{{ route('usuarios/editar') }}";
				}
				$.ajax({
					url: user_url,
					data : $('form#FormUsuario').serialize(),
					type: 'POST',
  					dataType : 'json',
					headers: {'Authorization': 'Bearer '+localStorage.getItem("token")},
					success: function(respuesta) {
					 	location.reload(true);
					},
					error: function() {
					  console.log("No se ha podido obtener la información");
					}
				});
			});
			
			

		});
	</script>
@endsection