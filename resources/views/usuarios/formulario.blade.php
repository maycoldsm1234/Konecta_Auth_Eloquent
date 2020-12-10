<div class="modal fade" id="modal-usuario" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="accion-usuario" value="nuevo" />
            <form id="FormUsuario">
                <div class="modal-header">
                    <h5 class="modal-title pull-left">Crear usuario</h5>
                </div>
                <div class="modal-body">
                
                    @csrf
                    <input type="hidden" id="id" name="id" value="" >
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
                                    @foreach (\App\Models\Role::all() as $role)
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn--icon-text">
                        <i class="zmdi zmdi-save"></i> Guardar
                    </button>
                    <button type="reset" class="btn btn-danger btn--icon-text" data-dismiss="modal">
                        <i class="zmdi zmdi-close-circle"></i> Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('script')
    @parent

    <script>
        $(function(){
            $( "#FormUsuario" ).validate({
                rules:{
                    email:{ email:true }
                },
                highlight: function (input) {
                    $(input).parents('.form-group').addClass('is-invalid');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-group').removeClass('is-invalid');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append('');
                }
            });

            $('#FormUsuario').on('submit', function(e){
                e.preventDefault();
                if($( "#FormUsuario" ).valid()){
                    if($('#accion-usuario').val() == 'nuevo'){
                        var url_pac ='{{ route("usuarios.agregar") }}';
                    }else{
                        var url_pac ='{{ route("usuarios.editar") }}';
                    }
                    $.ajax({
                        type:'POST',
                        url: url_pac,
                        data:$('#FormUsuario').serialize(),
                        dataType:'json',
                        beforeSend: function() {
                            swal({
                                title: 'Procesando informacion!',
                                html: '<div class="preloader pl-size-xs"><div class="spinner-layer pl-red-grey"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>',
                                showConfirmButton: false
                            });
                        },
                        success:function(response){
                            if(response.success){
                                swal({
                                    title: response.msg,
                                    type: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    $("#FormUsuario")[0].reset();
                                    usuarioCreado();
                                    $("#modal-usuario").modal("hide");
                                });
                            }else{
                                var msg = '';
                                $.each(response.error, function(index, value){
                                    var campo = $('#'+index).parents('.form-group').text();
                                    msg += campo+': '+value+'<br/>';
                                });
                                swal({
                                    title: 'Error de Validacion',
                                    html: msg,
                                    type: 'warning',
                                    buttonsStyling: false,
                                    confirmButtonClass: 'btn btn-primary'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection