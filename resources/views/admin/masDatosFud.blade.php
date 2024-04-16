@extends('adminlte::page')

@section('title', 'CEEAIV')


@section('content')
    <div class="card-body">
        @if (session('mensaje'))
            <div id="mensaje2" class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <div class=" text-white p-3">
           <div class="row">
            <div class="form-group col-md-6 text-left">
                <a href="javascript:history.back();" class="btn btn-warning  btn-md text-white"><span class="fas fa-caret-left"> Atrás</span></a>
            </div>
            <div class="form-group col-md-6 text-right ">
                <h6> <span class="text-primary"><b><u> FUD {{$estatusfud->consecutivo}}/{{$estatusfud->anio}} - {{$victima->nombre}} {{$victima->primerap}} {{$victima->segundoap}}</u></b></span></h6>
            </div>
            </div>
        </div>
        <ul class="nav nav-tabs nav-justified mb-3" id="defaultTabJustified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-justified" role="tab"
                    aria-controls="home" aria-selected="true"><i class="fa fa-people-arrows"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-justified" role="tab"
                    aria-controls="profile" aria-selected="false"><i class="fa fa-id-card"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cambio-tab-justified" data-toggle="tab" href="#cambio-justified" role="tab"
                    aria-controls="cambio" aria-selected="false"><i class="fas fa-map-marked-alt"></i> <i
                        class="fas fa-calendar-alt"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile2-tab-justified" data-toggle="tab" href="#profile2-justified" role="tab"
                    aria-controls="profile2" aria-selected="false"><i class="fa fa-eye"> <i
                            class="fa fa-book-open"></i></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile3-tab-justified" data-toggle="tab" href="#profile3-justified" role="tab"
                    aria-controls="profile3" aria-selected="false"><i class="fa fa-gavel"></i> <i
                        class="fa fa-landmark"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile4-tab-justified" data-toggle="tab" href="#profile4-justified" role="tab"
                    aria-controls="profile4" aria-selected="false"><i class="fa fa-file-signature"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile5-tab-justified" data-toggle="tab" href="#profile5-justified" role="tab"
                    aria-controls="profile5" aria-selected="false"><i class="fas fa-info-circle"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile6-tab-justified" data-toggle="tab" href="#profile6-justified" role="tab"
                    aria-controls="profile6" aria-selected="false"><b>. . . <i
                            class="fas fa-exclamation-triangle"></i></b></a>
            </li>
        </ul>
        <div class="tab-content" id="defaultTabJustifiedContent">
            {{-- Empiza Formulario Relacion de las victimas --}}
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab-justified">
                <div class="container">

                    <legend class="h6 text-primary">III.- RELACIÓN DE LA VÍCTIMA DIRECTA CON LA VÍCTIMA INDIRECTA</legend>
                    @if ($estatusfud->estatus == 'ACTIVO')
                        <button class="btn btn-md btn-success"
                            onclick="AgregarRelacion({{ $id_fud }},{{ $id_v }});">Agregar Relación</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar Relación</button>
                    @endif

                </div>
                <br>

                <div class="table table-responsive" id="listaVictimas">
                    <hr>
                    @if ($numRelaciones!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #05b684">
                            <tr>
                                <td>Victima Directa</td>
                                <td>Victima Indirecta</td>
                                <td>Relacion</td>
                                <td>Editar</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($relaciones as $relacion)
                                <tr>
                                    <td>{{ $relacion->nombre }}</td>
                                    <td>{{ $relacion->nvi }} {{ $relacion->primerap }} {{ $relacion->segundoap }}</td>
                                    <td>{{ $relacion->tipo_relacion }}</td>
                                    <td><button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario Relacion de las victimas --}}
            {{-- Empieza Formulario Identificaciones de la victima --}}
            <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab-justified">
                <div class="form-group col-md-4">

                    <legend class="h6 text-primary">IV.- IDENTIFICACIÓN DE LA VÍCTIMA</legend>
                    @if ($estatusfud->estatus == 'ACTIVO')
                        <button class="btn btn-md btn-success"
                            onclick="AgregarIde({{ $id_fud }},{{ $id_v }});">Adjuntar Ide</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar Ide</button>
                    @endif

                </div>

                <div class="table table-responsive" id="listaIdes">
                    <hr>
                    @if ($numIdes!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #05b684">
                            <tr>
                                <td>Tipo Identificación</td>
                                <td>Ver</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datosIdes as $datoIde)
                                <tr>
                                    <td>{{ $datoIde->tipo_ide }}</td>
                                    <td><button class="btn  btn-sm fas fa-address-card text-white"
                                            style="background-color: lightskyblue;"
                                            onclick="MuestraIde({{ $id_v }},{{ $datoIde->id_ide }});"></button>
                                    </td>
                                    <td><button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario Identificaciones de la victima --}}
            {{-- Empieza Formulario Lugar y fecha de los hechos --}}
            <div class="tab-pane fade" id="cambio-justified" role="tabpanel" aria-labelledby="cambio-tab-justified">
                <div class="form-group col-md-4">

                    <legend class="h6 text-primary">V.- LUGAR Y FECHA DE LOS HECHOS</legend>
                    @if ($estatusfud->estatus == 'ACTIVO')
                        <button class="btn btn-md btn-success"
                            onclick="AgregarLugarHechos({{ $id_fud }},{{ $id_v }});">Agregar Lugar y
                            Fecha</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar Lugar y Fecha</button>
                    @endif

                </div>

                <div class="table table-responsive" id="listaIdes">
                    <hr>
                    @if ($numHechos!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: ##05b684">
                            <tr>
                                <td>Lugar</td>
                                <td>Fecha</td>
                                <td>Hecho</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hechos as $hecho)
                                <tr>
                                    <td>{{ $hecho->calle }}, #{{ $hecho->no_exterior }} {{ $hecho->municipio }}
                                        {{ $hecho->localidad }}</td>
                                    <td>{{ $hecho->fecha }}</td>
                                    <td>{{ $hecho->hechos }}</td>
                                    <td><button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario Lugar y fecha de los hechos --}}
            {{-- Empieza Formulario OBSERVACIÓN PRELIMINAR --}}
            <div class="tab-pane fade" id="profile2-justified" role="tabpanel" aria-labelledby="profile2-tab-justified">
                <div class="form-group col-md-4">

                    <legend class="h6 text-primary">VI.- OBSERVACIÓN PRELIMINAR</legend>
                   {{--}} @if ($estatusfud->estatus == 'ACTIVO')
                        <button class="btn btn-md btn-success"
                            onclick="AgregarObservacion({{ $id_fud }},{{ $id_v }});">Agregar
                            Observación</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar Observación</button>
                    @endif--}}

                </div>

                <div class="table table-responsive" id="listaObs">
                    <hr>
                   {{--}} <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #285C4D">
                            <tr>
                                <td>Tipo daño</td>
                                <td>Descripción</td>
                                <td>Ver más</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>--}}
                    <p class="text-justify">Este apartado se encuentra incluido en el siguiente apartado, después de guardar a una autoridad, en el botón opciones podra agregar una o más observaciones para cada tipo de autoridad.</p>
                </div>
            </div>
            {{-- Termina Formulario OBSERVACIÓN PRELIMINAR  --}}
            {{-- Empieza Formulario  Autoridades que han conocido de los hechos --}}
            <div class="tab-pane fade" id="profile3-justified" role="tabpanel" aria-labelledby="profile3-tab-justified">
                <p class="h6 text-primary">VII.- AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</p>
                <div class="form-row">

                    @if ($estatusfud->estatus == 'ACTIVO')
                        <div class="form-group col-md-4">
                            <button class="btn btn-md btn-success"
                                onclick="AgregarAutMp({{ $id_fud }},{{ $id_v }});">Agregar Ministerio
                                Público</button>
                        </div>
                        <div class="form-group col-md-4">
                            <button class="btn btn-md btn-success"
                                onclick="AgregarAutPj({{ $id_fud }},{{ $id_v }});">Agregar Juzgado</button>
                        </div>
                        <div class="form-group col-md-4">
                            <button class="btn btn-md btn-success"
                                onclick="AgregarAutOdh({{ $id_fud }},{{ $id_v }});">Agregar Organismo
                                DH</button>
                        </div>
                    @else
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <button class="btn btn-md btn-secondary">Agregar Ministerio Público</button>
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-md btn-secondary">Agregar Juzgado</button>
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-md btn-secondary">Agregar Organismo DH</button>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="table table-responsive" id="listaAuts">
                    <hr>
                    @if ($numIm!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #49c09e">
                            <tr>
                                <td colspan="7">
                                    <center>Ministerio Público</center>
                                </td>
                            </tr>
                            <tr>
                                <td>Autoridad</td>
                                <td>Fecha</td>
                                <td>Competencia</td>
                                <td>Delitos</td>
                                <td>Observación Preliminar</td>
                                <td>Resumen</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inv_mins as $inv_min)
                                <tr>
                                    <td>{{ $inv_min->agencia_mp }}</td>
                                    <td>{{ $inv_min->fecha }}</td>
                                    <td>{{ $inv_min->competencia }}</td>
                                    <td>
                                        <a id="ver1" onclick="muestraDatosIm({{ $inv_min->id }})"
                                            href="#">Ver</a><a id="ocultar" href="#" onclick="ocultar1();" >Ocultar</a>
                                        <div id="ocultar1">
                                            <div id="resp{{ $inv_min->id }}"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a id="ver1ObIm" onclick="muestraDatosObIm({{ $inv_min->id }})"
                                                href="#">Ver</a><a id="ocultarObIm" href="#" onclick="ocultar2();" >Ocultar</a>
                                        <div id="ocultar1ObIm">
                                                <div id="respp{{ $inv_min->id }}"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info far fa-newspaper"></button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Opciones</button>
                                            <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarDelitoIm({{ $inv_min->id }},{{ $id_fud }});">Agregar Delitos</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarObservacionPreliminarMp({{ $inv_min->id }},{{ $id_fud }});">Agregar
                                                    Observacion</a>
                                                <a class="dropdown-item" href="#">Editar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif

                    @if ($numPj!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #1f9775">
                            <tr>
                                <td colspan="7">
                                    <center>Juzgados</center>
                                </td>
                            </tr>
                            <tr>
                                <td>Autoridad</td>
                                <td>Fecha</td>
                                <td>Competencia</td>
                                <td>Delitos</td>
                                <td>Observación Preliminar</td>
                                <td>Resumen</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($procesoJudicial as $pJ)
                                <tr>
                                    <td>{{ $pJ->num_juzgado }}</td>
                                    <td>{{ $pJ->fecha_inicio }}</td>
                                    <td>{{ $pJ->competencia }}</td>
                                    <td>
                                        <a id="ver1Pj" onclick="muestraDatos({{ $pJ->id }})"
                                                href="#">Ver</a><a id="ocultarPj" href="#" onclick="ocultar3();" >Ocultar</a>
                                        <div id="ocultar1Pj">
                                                <div id="res{{ $pJ->id }}"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a id="ver1ObPj" onclick="muestraDatosObPj({{ $pJ->id }})"
                                                href="#">Ver</a><a id="ocultarObPj" href="#" onclick="ocultar4();" >Ocultar</a>
                                                <div id="ocultar1ObPj">
                                        <div id="ress{{ $pJ->id }}"></div>
                                                </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info far fa-newspaper"></button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Opciones</button>
                                            <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarDelitoPj({{ $pJ->id }})">Agregar Delitos</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarObservacionPreliminarPj({{ $pJ->id }})">Agregar
                                                    Observacion</a>
                                                <a class="dropdown-item" href="#">Editar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif

                    @if ($numDh!=0)
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #49c09e">
                            <tr>
                                <td colspan="7">
                                    <center>Organismos de Derechos Humanos</center>
                                </td>
                            </tr>
                            <tr>
                                <td>Organismo</td>
                                <td>Fecha</td>
                                <td>Competencia</td>
                                <td>Violaciones</td>
                                <td>Observación Preliminar</td>
                                <td>Resumen</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organismosDh as $odh)
                                <tr>
                                    <td>{{$odh->organismo}}</td>
                                    <td>{{$odh->fecha_inicio}}</td>
                                    <td>{{$odh->competencia}}</td>
                                    <td>
                                        <a id="ver1Odh" onclick="muestraDatosOdh({{ $odh->id }})"
                                            href="#">Ver</a><a id="ocultarOdh" href="#" onclick="ocultar5();" >Ocultar</a>
                                            <div id="ocultar1Odh">
                                                <div id="re{{ $odh->id }}"></div>
                                            </div>
                                    </td>
                                    <td>
                                        <a id="ver1ObOdh" onclick="muestraDatosObOdh({{ $odh->id }})"
                                            href="#">Ver</a><a id="ocultarObOdh" href="#" onclick="ocultar6();" >Ocultar</a>
                                            <div id="ocultar1ObOdh">
                                                <div id="ree{{ $odh->id }}"></div>  
                                            </div>
                                    </td>
                                    <td> <button class="btn btn-sm btn-info far fa-newspaper"></button></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Opciones</button>
                                            <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarViolaciones({{ $odh->id }})">Agregar Violaciones</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="AgregarObservacionPreliminarOdh({{ $odh->id }})">Agregar
                                                    Observacion</a>
                                                <a class="dropdown-item" href="#">Editar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario Autoridades que han conocido de los hechos  --}}
            {{-- Empieza Formulario  Hoja de firmas --}}
            <div class="tab-pane fade" id="profile4-justified" role="tabpanel" aria-labelledby="profile4-tab-justified">
                <div class="form-group col-md-12">

                    <legend class="h6 text-primary">VIII.- HOJA DE FIRMAS</legend>
                    @if ($numSuscriptor==0)
                        <button class="btn btn-md btn-success"
                            onclick="AgregarHoja({{ $id_fud }},{{ $id_v }});">Adjuntar Hoja</button>
                    @else
                        <button class="btn btn-md btn-secondary">Adjuntar Hoja</button>
                    @endif

                </div>

                <div class="table table-responsive" id="listaHojas">
                    <hr>
                    @if (!empty($suscriptor))
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #05b684">
                            <tr>
                                <td>Suscriptor</td>
                                <td>Nombre Víctima</td>
                                <td>Resumen</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$suscriptor->tipo_suscriptor}}</td>
                                <td>{{$suscriptor->nombre}}</td>
                                <td><button class="btn btn-sm btn-info far fa-newspaper"></td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario  Hoja de firmas  --}}
            {{-- Empieza Formulario  INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA --}}
            <div class="tab-pane fade" id="profile5-justified" role="tabpanel" aria-labelledby="profile5-tab-justified">
                <div class="form-group col-md-12">

                    <legend class="h6 text-primary">IX.- INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA</legend>
                    @if ($estatusfud->estatus == 'ACTIVO' && $totalIc == 0)
                        <button class="btn btn-md btn-success"
                            onclick="AgregarInfoComp({{ $id_fud }},{{ $id_v }});">Agregar</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar</button>
                    @endif

                </div>

                <div class="table table-responsive" id="listaInfo">
                    <hr>
                    @if (!empty($infoComplementaria))
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #05b684">
                            <tr>
                                <td>Resumen</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="btn btn-sm btn-info far fa-newspaper" onclick="ResumenInfoComp({{ $id_v }});"></button></td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                        
                    @endif
                </div>
            </div>
            {{-- Termina Formulario INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA  --}}
            {{-- Empieza Formulario  MÁS INFORMACIÓN --}}
            <div class="tab-pane fade" id="profile6-justified" role="tabpanel" aria-labelledby="profile6-tab-justified">
                <div class="form-group col-md-12">

                    <legend class="h6 text-primary">X.- MÁS INFORMACIÓN</legend>
                    @if ($estatusfud->estatus == 'ACTIVO')
                        <button class="btn btn-md btn-success"
                            onclick="AgregarMasInfo({{ $id_fud }},{{ $id_v }});">Agregar</button>
                    @else
                        <button class="btn btn-md btn-secondary">Agregar</button>
                    @endif

                </div>

                <div class="table table-responsive" id="listaMasInfo">
                    <hr>
                    @if (!empty($masDatos->mas_info))
                    <table class="table  table-striped">
                        <thead class="text-white" style="background-color: #05b684">
                            <tr>
                                <td>Ver todo</td>
                                <td>Editar</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr> 
                                <td>
                                    <p class="text-justify">{{$masDatos->mas_info}}</p>  
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                                        
                                @endif
                </div>
            </div>
            {{-- Termina Formulario MÁS INFORMACIÓN  --}}
            <!--Empieza Modal -->
            <div class="container ">
                <div class="modal fade" id="empModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- <div class="card-header bg-info text-white col-lg" >
                                <h2 class="card-title">Datos Generales</h2>
                            </div> --}}
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Termina modal-->



        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $("#mensaje2").hide("slow");
            }, 3000);

            $("#ocultar").hide();
            $("#ocultarObIm").hide();
            $("#ocultarPj").hide();
            $("#ocultarObPj").hide();
            $("#ocultarOdh").hide();
            $("#ocultarObOdh").hide();

        });

        function AgregarRelacion(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarRelacion?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarIde(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarIdentificacion?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function MuestraIde(id_v, id_ide) {
            $('.modal-body').load('/admin/muestraIde?id_v=' + id_v, 'id_ide=' + id_ide, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarLugarHechos(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarLugarHechos?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarAutMp(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarAutMp?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarAutPj(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarAutPj?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarAutOdh(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarAutOdh?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarObservacion(id_fud, id_v) {

            $('.modal-body').load('/admin/agregarObservacion?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarDelitoIm(id_im, id_fud) {

            $('.modal-body').load('/admin/agregarDelitoIm?id_im=' + id_im, 'id_fud' + id_fud, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarObservacionPreliminarMp(id_im, id_fud) {

            $('.modal-body').load('/admin/agregarObservacionPreliminarMp?id_im=' + id_im, 'id_fud' + id_fud, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarDelitoPj(id_pj) {

            $('.modal-body').load('/admin/agregarDelitoPj?id_pj=' + id_pj, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarObservacionPreliminarPj(id_pj) {

            $('.modal-body').load('/admin/agregarObservacionPreliminarPj?id_pj=' + id_pj, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarViolaciones(id_odh){

            $('.modal-body').load('/admin/agregarViolaciones?id_odh=' + id_odh, function() {
                $('#empModal').modal('show');
            });
        }
        function AgregarObservacionPreliminarOdh(id_odh) {

            $('.modal-body').load('/admin/agregarObservacionPreliminarOdh?id_odh=' + id_odh, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarHoja(id_fud,id_v){

            $('.modal-body').load('/admin/agregarHoja?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarInfoComp(id_fud,id_v){

            $('.modal-body').load('/admin/agregarInfoComp?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function AgregarMasInfo(id_fud,id_v){

            $('.modal-body').load('/admin/agregarMasInfo?id_fud=' + id_fud, 'id_v=' + id_v, function() {
                $('#empModal').modal('show');
            });
        }

        function ResumenInfoComp(id_v){

$('.modal-body').load('/admin/resumenInfoComp?id_v=' + id_v, function() {
    $('#empModal').modal('show');
});
}

        function muestraDatosIm(id_im) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveDelitosIm",
                data: {
                    id_im: id_im
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#resp" + id_im).html(response);
                    $("#ocultar").show();//palabra ocultar que llama a la funcion ocultar1
                    $("#ocultar1").show();//div que oculta la respuesta
                    $("#ver1").hide();//palabra ver que llama a la funcion muestraDatosIm(ajax)
                    
                }
            });

        };

        function ocultar1(){
            $("#ocultar").hide();//palabra ocultar que llama a esta funcion
            $("#ocultar1").hide();//div que contiene la respuesta para ocultarla
            $("#ver1").show();//palabra ver que llama a la funcion muestraDatosIm(ajax)
        }

       

        function muestraDatosObIm(id_im) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveObservacionesIm",
                data: {
                    id_im: id_im
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#respp" + id_im).html(response);
                    $("#ocultarObIm").show();//palabra ocultar que llama a la funcion ocultar2
                    $("#ocultar1ObIm").show();//div que oculta la respuesta
                    $("#ver1ObIm").hide();//palabra ver que llama a la funcion muestraDatosObIm(ajax)
                }
            });
        };

        function ocultar2(){
            $("#ocultarObIm").hide();
            $("#ocultar1ObIm").hide();
            $("#ver1ObIm").show();
        }

        function muestraDatos(id_pj) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveDelitosPj",
                data: {
                    id_pj: id_pj
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#res" + id_pj).html(response);
                    $("#ocultarPj").show();//palabra ocultar que llama a la funcion ocultar2
                    $("#ocultar1Pj").show();//div que oculta la respuesta
                    $("#ver1Pj").hide();//palabra ver que llama a la funcion muestraDatosObIm(ajax)
                }
            });

        };

        function ocultar3(){
            $("#ocultarPj").hide();
            $("#ocultar1Pj").hide();
            $("#ver1Pj").show();
        }

        function muestraDatosObPj(id_pj) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveObservacionesPj",
                data: {
                    id_pj: id_pj
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#ress" + id_pj).html(response);
                    $("#ocultarObPj").show();//palabra ocultar que llama a la funcion ocultar2
                    $("#ocultar1ObPj").show();//div que oculta la respuesta
                    $("#ver1ObPj").hide();//palabra ver que llama a la funcion muestraDatosObIm(ajax)
                }
            });

        };

        function ocultar4(){
            $("#ocultarObPj").hide();
            $("#ocultar1ObPj").hide();
            $("#ver1ObPj").show();
        }

        function muestraDatosOdh(id_odh) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveViolacionesOdh",
                data: {
                    id_odh: id_odh
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#re" + id_odh).html(response);
                    $("#ocultarOdh").show();//palabra ocultar que llama a la funcion ocultar2
                    $("#ocultar1Odh").show();//div que oculta la respuesta
                    $("#ver1Odh").hide();//palabra ver que llama a la funcion muestraDatosObIm(ajax)
                }
            });

        };
        function ocultar5(){
            $("#ocultarOdh").hide();
            $("#ocultar1Odh").hide();
            $("#ver1Odh").show();
        }

        function muestraDatosObOdh(id_odh) {
            // alert(id_pj);
            $.ajax({
                type: "POST",
                url: "/admin/devuelveObservacionesOdh",
                data: {
                    id_odh: id_odh
                },
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $("#ree" + id_odh).html(response);
                    $("#ocultarObOdh").show();//palabra ocultar que llama a la funcion ocultar2
                    $("#ocultar1ObOdh").show();//div que oculta la respuesta
                    $("#ver1ObOdh").hide();//palabra ver que llama a la funcion muestraDatosObIm(ajax)
                }
            });

        };

        function ocultar6(){
            $("#ocultarObOdh").hide();
            $("#ocultar1ObOdh").hide();
            $("#ver1ObOdh").show();
        }

        
    </script>
@stop
