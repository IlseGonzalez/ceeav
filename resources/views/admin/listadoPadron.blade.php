@extends('adminlte::page')

@section('title', 'CEEAIV')

@section('content')
<div class="card-body">
    @if (session('mensaje'))
        <div id="mensaje2" class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <div class="xp-breadcrumbbar  text-center text-black">
        <h4 class="page-title text-black"><b>PADRÓN DE VÍCTIMAS</b></h4>
    </div>
        <div class="xp-contentbar">            
            <div class="row">
                <div class="col-lg-12 bg-table-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered " id="xp-edit-btn">
                            <thead>
                                <tr>
                                    <th>No. Folio</th>
                                    <th>Fecha</th>
                                    <th>Víctima</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Expediente</th>
                                    <th>Constancia</th>   
                                    {{--<th>Constancia</th> --}}
                                    <th>Opciones</th>      
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de fuds--}}   
                                @foreach ($listados as $listado)
                                    
                                
                                <tr>   
                                    <td>
                                        <b>{{$listado->nomenclatura}}</b>
                                    </td>
                                    <td align="center">
                                        {{--<input type="text" disabled name="fecha"  value=""> --}}
                                        {{$listado->fecha}}
                                    </td>
                                    <td align="left">
                                        {{ucfirst(strtolower($listado->nombre_victima))}} {{ucfirst(strtolower($listado->primer_apellido))}} {{ucfirst(strtolower($listado->segundo_apellido))}}
                                    </td>
                                    <td align="left">
                                        {{$listado->tipo_victima}}
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-md btn-success">{{ucfirst(strtolower($listado->estado))}}</button>
                                    </td>
                                    <td align="center">
                                        <a href="#" class="fa fa-folder-open" style="color: goldenrod; font-size:1.5em;"></a>
                                        
                                    </td>
                                    <td align="center">
                                        <a  href="{{route('constancia',['id_reg_fud'=>$listado->id_reg_fud])}}" target="_blank" class="far fa-file-pdf" style="color:red; font-size:1.6em;"></a> 
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
                                                <a class="dropdown-item text-red" href="#"></a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Editar</a>
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


    </script>
   
@stop
