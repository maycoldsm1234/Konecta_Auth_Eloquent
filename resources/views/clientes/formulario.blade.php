<div class="modal fade" id="modal-cliente" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="accion-cliente" value="nuevo" />
            <form id="FormCliente">
                <div class="modal-header">
                    <h5 class="modal-title pull-left">Crear cliente</h5>
                </div>
                <div class="modal-body">
                
                    @csrf
                    <input type="hidden" id="id" name="id" value="" >
                    <div class="row">
                        <label class="col-sm-4 col-form-label" style="text-align:right">Documento</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" id="documento" name="documento" class="form-control" placeholder="Documento" required>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                       </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label" style="text-align:right">Cliente</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" placeholder="Cliente nombre" required>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                       </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label" style="text-align:right">Direccion</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Direccion" required>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                       </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label" style="text-align:right">Telefono</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefonos" required>
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
            $( "#FormCliente" ).validate({
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

            $('#FormCliente').on('submit', function(e){
                e.preventDefault();
                if($( "#FormCliente" ).valid()){
                    if($('#accion-cliente').val() == 'nuevo'){
                        var url_pac ='{{ route("clientes.agregar") }}';
                    }else{
                        var url_pac ='{{ route("clientes.editar") }}';
                    }
                    $.ajax({
                        type:'POST',
                        url: url_pac,
                        data:$('#FormCliente').serialize(),
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
                                    $("#FormCliente")[0].reset();
                                    pacienteCreado();
                                    $("#modal-cliente").modal("hide");
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