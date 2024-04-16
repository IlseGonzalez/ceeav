@extends('adminlte::page')

@section('title', 'CEEAIV')

@section('content')
    <div class="xp-breadcrumbbar bg-info text-center text-white">
        <h4 class="page-title">Solicitudes</h4>
    </div>
        <div class="xp-contentbar">            
            <div class="row">
                <div class="col-lg-12 bg-table-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered " id="xp-edit-btn">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Forma</th>
                                    <th>Seguimiento</th>
                                    <th>Fecha</th>  
                                    <th>Estado</th>  
                                    <th>Victima</th> 
                                    <th>Editar</th>      
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de quejas en espera de firma--}}   
                                <tr>   
                                    <td>
                                        <a href="#">1</a>
                                    </td>
                                    <td>Email</td>
                                    <td align="center">
                                        <a  href="#" class="fa fa-folder-open"></a> 
                                    </td>
                                    <td align="center">
                                        <input type="date" name="fecha"  value="<?php echo date("Y-m-d");?>"> 
                                    </td>
                                    <td align="center">
                                        Tramite
                                    </td>
                                    <td align="center">
                                        Uriel Lopez Sanchez
                                    </td>
                                    <td align="center">
                                        <a  href="#" class="fa fa-edit"></a> 
                                    </td>    
                                </tr>             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop