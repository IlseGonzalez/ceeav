@extends('adminlte::page')

@section('title', 'CEEAIV')

@section('content')
    <div class="card-body">
        @if (session('mensaje'))
            <div id="mensaje2" class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <div class="xp-breadcrumbbar  text-center text-black">
            <h4 class="page-title text-black"><b>LISTADO DEL FORMATO ÚNICO DE DECLARACIÓN</b></h4>
        </div>
        <div class="xp-contentbar">
            <div class="row">
                <div class="col-lg-12 bg-table-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered " id="xp-edit-btn">
                            <thead>
                                <tr>
                                    <th>No. FUD</th>
                                    <th>Fecha</th>
                                    <th>Víctima</th>
                                    <th>Agregar</th>
                                    <th>Dictaminación</th>
                                    {{-- <th>Constancia</th> --}}
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de fuds --}}
                                @foreach ($listados as $listado)
                                    <tr>
                                        <td>
                                            <p><b>{{ $listado->consecutivo }}/{{ $listado->anio }}</b></p>
                                        </td>
                                        <td align="center">
                                            {{-- <input type="text" disabled name="fecha"  value=""> --}}
                                            {{ $listado->fecha }}
                                        </td>
                                        <td align="left">

                                            {{ ucfirst(strtolower($listado->nombre)) }}
                                            {{ ucfirst(strtolower($listado->primerap)) }}
                                            {{ ucfirst(strtolower($listado->segundoap)) }}
                                        </td>
                                        <td align="center">
                                            <a
                                                href="{{ route('masDatosFud', ['id_fud' => $listado->id_fud, 'id_v' => $listado->id_v]) }}"><button
                                                    class="btn bg-maroon"><i class="fas fa-plus"
                                                        style="font-size: 0.8em;"></i> Info</button></a>

                                        </td>
                                        <td align="center">
                                            <button class="btn btn-md bg-olive">
                                                <font style=" color:white;">Dictaminar</font>
                                            </button>
                                        </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Opciones</button>
                                                <button type="button"
                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-red" href="#"
                                                        onclick="InscripcionPadron({{ $listado->id_fud }} )">Inscribir al
                                                        Padron</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item" onclick="Editar1form({{$listado->id_fud}})">Editar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

        });

        function InscripcionPadron(id_fud) {

            $('.modal-body').load('/admin/inscripcionPadron?id_fud=' + id_fud, function() {
                $('#empModal').modal('show');
            });
        }

        function Editar1form(id_fud) {
//alert(id_fud);
            $('.modal-body').load('/admin/editar1Form?id_fud=' + id_fud, function() {
                $('#empModal').modal('show');
            });
        }
    </script>
@stop
