@extends('adminlte::page')

@section('title', 'CEEAV')

@section('content')

    <div class="card text-white" style="background-color: #9D2449">
        <center>
            <h6>REGISTRAR DATOS DEL FORMATO ÚNICO DE DECLARACIÓN</h6>
        </center>
    </div>
    <div class="card-header">
        @if (session('mensaje'))
            <div id="mensaje2" class="alert-success">{{ session('mensaje') }}</div>
        @endif
    </div>
    <center>

        <div class="card-body">
            <form id="guardarFud" action="{{ route('guardarFud') }}" class="needs-validation" 
                method="POST">
                @csrf
                <!-- ESTATUS HIDDEN -->
                <input type="hidden" name="estatus" id="estatus" value="ACTIVO">
                <input type="hidden" id="id_u" name="id_u" value="{{ auth()->id() }}">

                <!-- Tipo de visita, asunto, fecha y hora-->
                <div class="form-row needs-validation">
                    <div class="form-group col-md-9">
                        <label for="lugar">Lugar</label>
                        <input type="text" class="form-control" id="lugar" name="lugar" required />

                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>"
                            required />

                    </div>
                </div>
                <div class="card text-white" style="background-color: #9D2449">
                    <center>
                        <h6>I. DATOS DE LA PERSONA SOLICITANTE</h6>
                    </center>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="tipoSol">La presente solicitud se realiza por:</label>
                        <select id="tipoSol" name="tipoSol" class="custom-select" onchange="MuestraOcultaBoc()" required>
                            <option value="" selected>Selecciona una opción [. . .]</option>
                            @foreach ($tipo_solicitantes as $tipo_solicitante)
                                <option value="{{ $tipo_solicitante->id }}" data-tipoc="{{ $tipo_solicitante->id }}">
                                    {{ $tipo_solicitante->tipo_solicitante }}
                                </option>
                            @endforeach

                        </select>

                    </div>
                </div>
                <div id="bOc" style="display: none;">
                    <div class="card text-white" style="background-color: #9D2449">
                        <center>
                            <h6>Este apartado se deberá requisitar cuando el formato sea llenado por B o C y posteriormente
                                continuar en
                                II.</h6>
                        </center>
                    </div>
                    <!-- nombre, apellido paterno y materno -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nombreSol">Nombre(s)</label>
                            <input type="text" class="form-control" id="nombreSol" name="nombreSol"
                                placeholder="Escribe tu nombre o nombres" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                             />

                        </div>
                        <div class="form-group col-md-3">
                            <label for="apeSol">Primer Apellido</label>
                            <input type="text" class="form-control" id="apeSol" name="apeSol"
                                placeholder="Escribe tu apellido paterno" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" />

                        </div>
                        <div class="form-group col-md-3">
                            <label for="apeMatSol">Segundo Apellido</label>
                            <input type="text" class="form-control" id="apeMatSol" name="apeMatSol"
                                placeholder="Escribe tu apellido materno" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]++" />

                        </div>
                        <div class="form-group col-md-3">
                            <label for="curp">Curp</label>
                            <input type="text" class="form-control" id="curpSol" name="curpSol"
                                placeholder="Escribe tu curp" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="parentesco">Parentesco/relación afectiva*</label>
                            <input type="text" class="form-control" id="parentesco" name="parentesco"
                                placeholder="Escribe tu parentesco" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]++" />

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cargo">Cargo **</label>
                            <input type="text" class="form-control" id="cargo" name="cargo"
                                placeholder="Escribe tu cargo" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]++"  />

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="dependencia">Dependencia o institución **</label>
                            <select class="form-control" id="dependencia" name="dependencia" >
                                <option value="0">Selecciona una dependencia</option>
                                @foreach ($dependencias as $dependencia)
                                    <option value="{{ $dependencia->id }}">{{ $dependencia->nom_dependencia }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tel_movil">Telefono Movil</label>
                            <input type="number" class="form-control" id="tel_movil" name="tel_movil"
                                placeholder="Escribe tu numero de telefono celular" minlength="3" maxlength="15" />

                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel_fijo">Telefono Fijo</label>
                            <input type="text" class="form-control" id="tel_fijo" name="tel_fijo"
                                placeholder="Escribe tu numero telefonico de casa, oficina o negocio" minlength="3"
                                maxlength="15" />

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Escribe tu correo@email.com"
                                pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="otros_datos">Otros datos de contacto</label>
                            <input type="text" class="form-control" id="otros_datos" name="otros_datos"
                                placeholder="" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]++" />

                        </div>
                    </div>
                </div>
                <!-- II Tipo y datos de la victima-->
                <div id="aOb" style="display: none;">
                    <div class="card text-white" style="background-color: #9D2449">
                        <center>
                            <h6>II. TIPO Y DATOS DE LA VÍCTIMA</h6>
                        </center>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="tipo">Tipo Víctima</label>
                            <select class="form-control" id="tipoV" name="tipoV" required>
                                <option value="">Selecciona una opción [. . .]</option>
                                @foreach ($tipoVictimas as $tipoVictima)
                                    <option value="{{ $tipoVictima->id }}">{{ $tipoVictima->tipo }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Escribe tu nombre o nombres" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                                required />

                        </div>
                        <div class="form-group col-md-4">
                            <label for="ape_pat">Primer Apellido</label>
                            <input type="text" class="form-control" id="ape_pat" name="ape_pat"
                                placeholder="Escribe tu apellido paterno" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" required />

                        </div>
                        <div class="form-group col-md-4">
                            <label for="ape_mat">Segundo Apellido</label>
                            <input type="text" class="form-control" id="ape_mat" name="ape_mat"
                                placeholder="Escribe tu apellido materno" minlength="3" maxlength="50"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]++" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="fechaNac">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNac" name="fechaNac" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edad">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" min="0"
                                max="100" placeholder="Edad" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sexo">Sexo</label>
                            <select id="sexo" name="sexo" class="custom-select" required>
                                <option value="" selected disabled>Selecciona una opcion [...]</option>
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                                <option value="NI">No Identificado</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nacionalidad">Nacionalidad</label>
                            <select class="form-control" id="nacionalidad" name="nacionalidad">
                                <option value="257" disabled selected>MEXICANA</option>
                                @foreach ($gentilicios as $gentilicio)
                                    <option value="{{ $gentilicio->id }}">{{ $gentilicio->gentilicio }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="curp">Curp</label>
                            <input type="text" class="form-control" id="curp" name="curp"
                                placeholder="Escribe tu curp" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="estado_civil">Estado civil</label>
                            <select id="estado_civil" name="estado_civil" class="custom-select" required>
                                <option value="" disabled selected> Seleciona una opcion [...]</option>
                                @foreach ($edos_civiles as $edo_civil)
                                    <option value="{{ $edo_civil->id }}">{{ $edo_civil->estado_civil }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tel_movilVic">Telefono Movil</label>
                            <input type="number" class="form-control" id="tel_movil" name="tel_movil"
                                placeholder="Escribe tu numero de telefono celular" minlength="3" maxlength="15" />

                        </div>
                        <div class="form-group col-md-4">
                            <label for="tel_fijoVic">Telefono Fijo</label>
                            <input type="text" class="form-control" id="tel_fijo" name="tel_fijo"
                                placeholder="Escribe tu numero telefonico de casa, oficina o negocio" minlength="3"
                                maxlength="15" />
                        </div>
                    </div>
                    <div class="card bg-gray">
                        <center><span><b>Lugar de nacimiento</b></span></center>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pais">Pais</label>
                            <select id="paisV" name="paisV" class="custom-select" required>
                                <option value="257" selected>MEXICO</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="entFedV">Entidad Federativa</label>
                            <select id="entFedV" name="entFedV" class="custom-select" required>
                                <option disabled selected>Selecciona una opción [...]</option>
                                @foreach ($ent_federativas as $ent_federativa)
                                    <option value="{{ $ent_federativa->id }}">{{ $ent_federativa->estado }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="municipioV">Municipio</label>
                            <select id="municipioV" name="municipioV" class="custom-select" onchange="BuscaLocalidad()"
                                required>
                                <option disabled selected>Selecciona una opción [...]</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" data-tipoa="{{ $municipio->id }}">
                                        {{ $municipio->municipio }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="localidadV">Población/comunidad</label>
                            <select id="localidadV" name="localidadV" class="custom-select" required>
                                <option disabled selected>Selecciona una opción [...]</option>

                            </select>
                        </div>
                    </div>
                    <div class="card bg-gray">
                        <center><span><b>Domicilio</b></span></center>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="calleV">Calle</label>
                            <input type="text" class="form-control" id="calleV" name="calleV"
                                placeholder="Escribe el nombre de la calle donde vives" minlength="3" maxlength="100"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                                required />

                        </div>
                        <div class="form-group col-md-3">
                            <label for="noExteriorV">No. Exterior</label>
                            <input type="number" class="form-control" id="noExteriorV" name="noExteriorV"
                                placeholder="Escribe el numero de la casa donde vives" minlength="3" maxlength="10"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                                required />

                        </div>
                        <div class="form-group col-md-3">
                            <label for="noInteriorV">No. Interior</label>
                            <input type="number" class="form-control" id="noInteriorV" name="noInteriorV"
                                placeholder="Escribe el numero interior de la casa donde vives" minlength="3"
                                maxlength="10" pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+"
                                autocomplete="on" required />

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="cpV">Código Postal</label>
                            <input type="number" class="form-control" id="cpV" name="cpV"
                                placeholder="Escribe el numero de la casa donde vives" minlength="3" maxlength="5"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                                required />

                        </div>
                        <div class="form-group col-md-9">
                            <label for="coloniaV">Colonia</label>
                            <input type="text" class="form-control" id="coloniaV" name="coloniaV"
                                placeholder="Escribe el nombre de la calle donde vives" minlength="3" maxlength="100"
                                pattern="[A-Z(Á|É|Í|Ó|Ú|Ñ|)][A-Z(Á|É|Í|Ó|Ú|Ñ|)a-z-(á|é|í|ó|ú|ñ)\s]+" autocomplete="on"
                                required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="entFedDomV">Entidad Federativa</label>
                            <select id="entFedDomV" name="entFedDomV" class="custom-select" required>
                                <option disabled selected>Selecciona una opción [...]</option>
                                @foreach ($ent_federativas as $ent_federativa)
                                    <option value="{{ $ent_federativa->id }}">{{ $ent_federativa->estado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="municipioDomV">Municipio</label>
                            <select id="municipioDomV" name="municipioDomV" class="custom-select"
                                onchange="BuscaLocalidad2()" required>
                                <option disabled selected>Selecciona una opción [...]</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" data-tipob="{{ $municipio->id }}">
                                        {{ $municipio->municipio }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="localidadDomV">Localidad</label>
                            <select id="localidadDomV" name="localidadDomV" class="custom-select" required>
                                <option disabled selected>Selecciona una opción [...]</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailVic">Correo Electrónico</label>
                            <input type="emailVic" class="form-control" id="emailVic" name="emailVic"
                                placeholder="Escribe tu correo@email.com"
                                pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" />
                        </div>
                    </div>

                    <hr>
                    <div class="form-row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>


    @stop

    @section('css')
        
    @stop

    @section('js')
        <script>
            $(document).ready(function() {
                $('#bOc').hide();
                $('#aOb').hide();
            });

            function BuscaLocalidad() {
                var id_municipio = $("#municipioV").find(':selected').data('tipoa');

                $.ajax({
                    type: "POST",
                    url: "/admin/muestraLocalidades",
                    data: {
                        id_municipio: id_municipio,
                        mostrar: 'localidad'
                    },
                    dataType: "html",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#localidadV').focus();
                        $("#localidadV").html(response);
                    }
                });
            }

            function BuscaLocalidad2() {
                var id_municipio = $("#municipioDomV").find(':selected').data('tipob');

                $.ajax({
                    type: "POST",
                    url: "/admin/muestraLocalidades",
                    data: {
                        id_municipio: id_municipio,
                        mostrar: 'localidad'
                    },
                    dataType: "html",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#localidadDomV').focus();
                        $("#localidadDomV").html(response);
                    }
                });
            }

            function MuestraOcultaBoc() {
                var idBoc = $('#tipoSol').val();
                if (idBoc == 2 || idBoc == 3) {
                    $('#bOc').show();
                    $('#aOb').show();
                } else {
                    $('#bOc').hide();
                    $('#aOb').show();
                }
            }
        </script>

    @stop
