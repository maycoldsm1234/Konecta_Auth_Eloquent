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
            <table id="table-clientes" class="table table-bordered">
                <thead class="thead-default">
                    <tr>
                        <th width="15%">Documento</th>
						<th width="25%">Cliente</th>
						<th width="15%">Correo</th>
						<th width="20%">Direccion</th>
						<th width="15%">Telefonos</th>
						<th>Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="Btn-NuevoCli" class="btn btn-primary btn-lg btn--icon" href="#modal-cliente" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="display: block;">
            <i class="zmdi zmdi-account-add"></i>
        </button>
    </div>
    {{ view('clientes.formulario') }}
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
            $('#table-clientes').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('clientes') }}",
                    "data": { "_token" : "{{ csrf_token() }}" },
                    "type": "POST"
                },
                columns: [
                    {data: 'documento', name: 'documento'},
                    {data: 'nombre_completo', name: 'nombre_completo'},
                    {data: 'email', name: 'email'},
                    {data: 'direccion', name: 'direcicon'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [{
                    targets: [0,2,3,4,5],
                    className:'text-center'
                }]
            });            
        });

        $('#Btn-NuevoCli').on('click', function(){
            $("#FormCliente")[0].reset();
            $('#FormCliente #id').val('0');
        });

        $('#table-clientes').on('click', '.btn-editar', function(){
            $("#FormCliente")[0].reset();
            var url = '{{ route("clientes.buscar", ["id" => ":id"]) }}';
            url = url.replace(':id', $(this).data('id'));
            $('#accion-cliente').val('editar');
            $('.modal-title').html('Editar cliente');
            $.ajax({
                type:'POST',
                url: url,
                data: { "_token" : "{{ csrf_token() }}" },
                dataType:'json',
                success:function(response){
                    $.each(response, function(index, value){
                        $('#FormCliente #'+index).val(value);
                        $('#FormCliente #'+index).trigger('blur');
                    });
                    $("#modal-cliente").modal("show");
                }
            });
        });

        $('#table-clientes').on('click', '.btn-eliminar', function(){
            var $id = $(this).data('id');
            $.ajax({
                type:'POST',
                url: '{{ route("clientes.eliminar") }}',
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
                        }).then(function(){
                            $('#table-clientes').DataTable().ajax.reload();
                        });
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

        function pacienteCreado(){
            $('#table-clientes').DataTable().ajax.reload();
        }
    </script>
@endsection