<div class="modal fade" id="formulario-paciente" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">Nuevo paciente</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="accion-paciente" value="nuevo" />
                <form id="form-pacientes">
                    <input type="hidden" name="id" id="id" value="0" />
                    @csrf
                    <div class="row">
                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Tipo de documento</label>
                                <select id="pac_tipo_doc" name="pac_tipo_doc" required>
                                    <option value="" selected>--Seleccione--</option>
                                    <option value="CC">CEDULA DE CIUDADANIA</option>
                                    <option value="CE">CEDULA DE EXTRANJERIA</option>
                                    <option value="PA">PASAPORTE</option>
                                    <option value="RC">REGISTRO CIVIL</option>
                                    <option value="TI">TARJETA DE IDENTIDAD</option>
                                    <option value="AS">ADULTO SIN IDENTIFICACION</option>
                                    <option value="MS">MENOR SIN IDENTIDICACION</option>
                                    <option value="NU">NUMERO UNICO DE IDENTIFICACION</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_documento" name="pac_documento">
                                <label>Documento</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_apellido1" name="pac_apellido1">
                                <label>1° Apellido</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_apellido2" name="pac_apellido2">
                                <label>2° Apellido</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>   

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_nombre1" name="pac_nombre1">
                                <label>1° Nombre</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input type="text" class="form-control" id="pac_nombre2" name="pac_nombre2">
                                <label>2° Nombre</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-group--float">
                                <input required type="text" class="form-control" id="pac_fnaci" name="pac_fnaci">
                                <label>Fecha nacimiento</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Sexo</label>
                                <select required id="pac_sexo" name="pac_sexo" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>  
                        
                        <div class="col-md-6">
                            <div class="form-group form-group--float">
                                <input required type="text" class="form-control" id="pac_ocupacion" name="pac_ocupacion">
                                <label>Ocupacion</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Municipio</label>
                                <select required id="pac_ciudad" name="pac_ciudad" class="pac_select2" data-url="ciudades">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>  
                        
                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_dir" name="pac_dir">
                                <label>Direccion</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input required type="text" class="form-control" id="pac_bar" name="pac_bar">
                                <label>Barrio</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Zona</label>
                                <select required id="pac_zona" name="pac_zona" class="pac_select2" data-url="zonas" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Grupo poblacional</label>
                                <select required id="pac_gp" name="pac_gp" class="pac_select2" data-url="grupo_poblacional" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Etnia</label>
                                <select required id="pac_etnia" name="pac_etnia" class="pac_select2" data-url="etnias" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>   

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input type="text" class="form-control" id="pac_tel" name="pac_tel">
                                <label>Telefono</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group form-group--float ">
                                <input type="email" class="form-control" id="pac_email" name="pac_email">
                                <label>Email</label>
                                <i class="form-group__bar"></i>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group select-form-group-float">
                                <label>Entidad</label>
                                <select required id="pac_entidad" name="pac_entidad" class="pac_select2" data-url="entidades">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Regimen</label>
                                <select required id="pac_regimen" name="pac_regimen" class="pac_select2" data-url="regimen" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Municipio fosyga</label>
                                <select required id="pac_mpiofosyga" name="pac_mpiofosyga" class="pac_select2" data-url="ciudades">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Rango salarial</label>
                                <select required id="pac_rangos" name="pac_rangos" class="pac_select2" data-url="rango_salarial" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Clase de afiliado</label>
                                <select required id="pac_clase" name="pac_clase" class="pac_select2" data-url="clase_afiliacion" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <div class="form-group select-form-group-float">
                                <label>Nivel Sisben</label>
                                <select required id="pac_sisben" name="pac_sisben" class="pac_select2" data-url="sisben" data-minimum-results-for-search="Infinity">
                                    <option value="" selected>--Seleccione--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="form-guardar-pac" type="button" class="btn btn-primary btn--icon-text">
                    <i class="zmdi zmdi-save"></i> Guardar
                </button>
                <button type="button" class="btn btn-danger btn--icon-text" data-dismiss="modal">
                    <i class="zmdi zmdi-close-circle"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@section('script')
    @parent

    <script>
        $(function(){
            $('#pac_tipo_doc, #pac_zona, #pac_sexo').select2({
                width: '100%',
                dropdownParent: $('#formulario-paciente')
            }).on('select2:select', function(){
                $(this).trigger('blur');
            });

            $('.pac_select2').select2({
                width: '100%',
                dropdownParent: $('#formulario-paciente'),
                ajax: {
                    url: function(){
                        var url = '{{ route("select2", ["tipo" => ":tipo"]) }}';
                        url = url.replace(':tipo', $(this).data('url'));
                        return url;
                    },
                    type:'post',
                    data: function (params) {
                        return {
                            term: params.term, // search term
                            _token : "{{ csrf_token() }}"
                        };
                    },
                    dataType: 'json',
                }
            }).on('select2:select', function(){
                $(this).trigger('blur');
            });

            $("#pac_fnaci").flatpickr({
                dateFormat: "Y-m-d",
                locale: flatParameters()
            });

            $( "#form-pacientes" ).validate({
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

            $('#form-guardar-pac').on('click', function(){
                if($( "#form-pacientes" ).valid()){
                    if($('#formulario-paciente #accion-paciente').val() == 'nuevo'){
                        var url_pac ='{{ route("pacientes.agregar") }}';
                    }else{
                        var url_pac ='{{ route("pacientes.editar") }}';
                    }
                    $.ajax({
                        type:'POST',
                        url: url_pac,
                        data:$('#form-pacientes').serialize(),
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
                                    $("#form-pacientes")[0].reset();
                                    $('#formulario-paciente select').val('').trigger('change');
                                    $("#formulario-paciente").modal("hide");
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