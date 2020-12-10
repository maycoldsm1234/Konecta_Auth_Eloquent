@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('theme/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/vendors/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <div class="table-responsive">
            <table id="table-usuarios" class="table table-bordered">
                <thead class="thead-default">
                    <tr>
                        <th width="15%">Usuario</th>
                        <th width="30%">Nombre</th>
                        <th width="30%">Correo</th>
                        <th width="15%">Rol</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="Btn-Nuevo" class="btn btn-primary btn-lg btn--icon" href="#modal-usuario" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="display: block;">
            <i class="zmdi zmdi-account-add"></i>
        </button>
    </div>
    {{ view('usuarios.formulario') }}
</div>
@endsection

@section('script')
    <script src="{{ asset('theme/vendors/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('theme/vendors/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('theme/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function(){
            $('#table-usuarios').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('usuarios') }}",
                    "data": { "_token" : "{{ csrf_token() }}" },
                    "type": "POST"
                },
                columns: [
                    {data: 'username', name: 'username'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles.[].description', name: 'roles.[].description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [{
                    targets: [0,2,4],
                    className:'text-center'
                }]
            });            
        });

        $('#Btn-Nuevo').on('click', function(){
            $("#FormUsuario")[0].reset();
            $('#FormUsuario #id').val('0');
            $('#accion-usuario').val('agregar');
            $('#modal-usuario .password').show();
            $('.modal-title').html('Agregar usuario');
        });

        $('#table-usuarios').on('click', '.btn-editar', function(){
            $("#FormUsuario")[0].reset();
            var url = '{{ route("usuarios.buscar", ["id" => ":id"]) }}';
            url = url.replace(':id', $(this).data('id'));
            $('#accion-usuario').val('editar');
            $('#modal-usuario .password').hide();
            $('.modal-title').html('Editar usuario');

            $.ajax({
                type:'POST',
                url: url,
                data: { "_token" : "{{ csrf_token() }}" },
                dataType:'json',
                success:function(response){
                    $.each(response, function(index, value){
                        $('#FormUsuario #'+index).val(value);
                        $('#FormUsuario #'+index).trigger('blur');
                    });

                    $('#FormUsuario #role').val(response.roles[0].name);
                    $("#modal-usuario").modal("show");
                }
            });
        });

        $('#table-usuarios').on('click', '.btn-eliminar', function(){
            var $id = $(this).data('id');
            $.ajax({
                type:'POST',
                url: '{{ route("usuarios.eliminar") }}',
                data: { 
                    id: $id,
                    "_token" : "{{ csrf_token() }}" },
                dataType:'json',
                success:function(response){
                    if(response.success){
                        swal({
                            title: response.msg,
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#table-usuarios').DataTable().ajax.reload();
                        $("#modal-usuario").modal("hide");
                    }else{
                        swal({
                            title: 'Error',
                            html: msg,
                            type: 'warning',
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-primary'
                        });
                    }
                }
            });
        });

        function usuarioCreado(){
            $('#table-usuarios').DataTable().ajax.reload();
        }
    </script>
@endsection