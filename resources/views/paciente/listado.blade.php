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
            <table id="table-pacientes" class="table table-bordered">
                <thead class="thead-default">
                    <tr>
                        <th width="10%">Documento</th>
                        <th width="5%">Tipo</th>
                        <th width="60%">Nombre Completo</th>
                        <th width="5%">Sexo</th>
                        <th>Entidad</th>
                        <th width="10%">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="Btn-NuevoPac" class="btn btn-primary btn-lg btn--icon" href="#formulario-paciente" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="display: block;">
            <i class="zmdi zmdi-account-add"></i>
        </button>
    </div>
    {{ view('paciente.formulario') }}
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
            $('#table-pacientes').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('pacientes') }}",
                    "data": { "_token" : "{{ csrf_token() }}" },
                    "type": "POST"
                },
                columns: [
                    {data: 'pac_documento', name: 'pac_documento'},
                    {data: 'pac_tipo_doc', name: 'pac_tipo_doc'},
                    {data: 'pac_nombre', name: 'pac_nombre'},
                    {data: 'pac_sexo', name: 'pac_sexo'},
                    {data: 'entidad.enti_siglas', name: 'entidad.enti_siglas'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [{
                    targets: [1,3,4,5],
                    className:'text-center'
                }]
            });            
        });

        $('#Btn-NuevoPac').on('click', function(){
            $("#form-pacientes")[0].reset();
            $('#formulario-paciente select').val('').trigger('change');
            $('#formulario-paciente #accion-paciente').val('nuevo');
            $('#formulario-paciente .modal-title').html('Nuevo paciente');
            $('#formulario-paciente #id').val('0');
        });

        $('#table-pacientes').on('click', '.btn-editar', function(){
            $("#form-pacientes")[0].reset();
            var url = '{{ route("pacientes.buscar", ["id" => ":id"]) }}';
            url = url.replace(':id', $(this).data('id'));
            $('#formulario-paciente #accion-paciente').val('editar');
            $('#formulario-paciente .modal-title').html('Editar paciente');
            $.ajax({
                type:'POST',
                url: url,
                data: { "_token" : "{{ csrf_token() }}" },
                dataType:'json',
                success:function(response){
                    $.each(response, function(index, value){
                        $('#formulario-paciente #'+index).val(value);
                        $('#formulario-paciente #'+index).trigger('blur');
                        if($("#formulario-paciente select#"+index).length){
                            if($("#formulario-paciente select#"+index).attr("data-url")){
                                var urlsel = '{{ route("select2", ["tipo" => ":tipo"]) }}';
                                    urlsel = urlsel.replace(':tipo', $('#formulario-paciente #'+index).data('url'));
                                $.ajax({
                                    url: urlsel, 
                                    type:'post',
                                    data: { 
                                        buscarid: value,
                                        "_token" : "{{ csrf_token() }}"
                                    },
                                    dataType: "json",
                                    success:function(dataSel){
                                        var Selec = dataSel.results;
                                        var option = new Option(Selec.text, Selec.id, true, true);
                                        $("#formulario-paciente select#"+index).append(option).trigger('change');
                                    }
                                });
                            }
                        }
                    });
                    $('#formulario-paciente select').trigger('change');
                    $("#formulario-paciente").modal("show");
                }
            });
        });

        $('#table-pacientes').on('click', '.btn-eliminar', function(){
            var $id = $(this).data('id');
            $.ajax({
                type:'POST',
                url: '{{ route("pacientes.eliminar") }}',
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
                            $('#table-pacientes').DataTable().ajax.reload();
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

        function pacienteCreado(pac_documento){
            $('#table-pacientes').DataTable().ajax.reload();
        }
    </script>
@endsection