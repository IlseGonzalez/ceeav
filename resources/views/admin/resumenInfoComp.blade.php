<!-- IX. Información complementaria de la persona víctima -->
<div class="card text-white" style="background-color: rgb(139, 0, 69)">
    <center>
        <h6>IX. INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA</h6>
    </center>
</div>

    <div class="form-row">
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">1</td>
                    <td class=" bg-white col-md-5">¿Es niña/o o adolescente?<br>
                       <input type="text" disabled name="nina" id="nina" class="form-control" value="{{$datos->nina_adolescente}}"> 
                        
                    </td>
                    <td class=" bg-white col-md-5">Nombre del tutor/a
                        <input type="text" disabled id="tutor" name="tutor" class="form-control" value="{{$datos->tutor}}">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td colspan="2" class=" bg-white col-md-10">Datos de contacto del tutor/a
                        <input type="text" disabled id="contactoTutor" name="contactoTutor" class="form-control" value="{{$datos->contacto_tutor}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">2</td>
                    <td class=" bg-white col-md-5">¿Es persona adulta mayor?<br>
                        <input type="text" disabled name="adulto" id="adulto" value="{{$datos->adulto_mayor}}">
                    </td>
                    <td class="col-md-1" style="background-color: rgb(242, 245, 245)">3</td>
                    <td class=" bg-white col-md-4">¿Se encuentra en situación de calle? <br>
                        <input type="text" disabled name="calle" id="calle" class="form-control" value="{{$datos->situacion_calle}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="7" class="col-md-2" style="background-color: rgb(242, 245, 245)">4</td>
                    <td colspan="2" class=" bg-white col-md-10">¿Tiene condición de discapacidad?&nbsp;
                        <input type="text" disabled name="discapacidad" class="form-control col-md-2" value="{{$datos->discapacidad}}">
                    </td>
                </tr>
                <tr class="col-md-12" style="background-color: rgb(242, 245, 245)">
                    <td class="col-md-3" align="center">Tipo</td>
                    <td class="col-md-7" align="center">Grado de dependencia</td>
                </tr>
                @foreach ($discapacidades as $discapacidad)
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="text" id="dis" name="dis" disabled class="form-control" value="{{$discapacidad->tipo}}"> 
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="text" id="dep" name="dependencia" disabled class="form-control" value="{{$discapacidad->grado}}">
                        </center>
                    </td>
                </tr>
                @endforeach 
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">5</td>
                    <td class=" bg-white col-md-5">¿Pertenece a población/comunidad indígena?<br>
                        <input type="text" id="indigena" name="indigena" disabled class="form-control" value="{{$datos->indigena}}"> 
                    </td>
                    <td class=" bg-white col-md-5"> ¿A cual?<br>
                        <input type="text" name="etnia" disabled class="form-control" value="{{$datos->poblacion_ind}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">6</td>
                    <td class=" bg-white col-md-3">¿Es migrante?&nbsp;&nbsp;
                        <input type="text" id="migranteSi" name="migrante" disabled class="form-control" value="{{$datos->migrante}}">
                    </td>
                    <td class=" bg-white col-md-3"> País de origen
                        <input type="text" disabled class="form-control" id="paisOrigen" name="paisOrigen" value="{{$datos->pais_origen}}">
                    </td>
                    <td class=" bg-white col-md-3"> País de destino
                        <input type="text" disabled class="form-control" id="paisDestino" name="paisDestino" value="{{$datos->pais_destino}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">7</td>
                    <td class=" bg-white col-md-5">¿Qué idioma habla? <br>
                        <input type="text" id="idioma" name="idioma" class="form-control" disabled value="{{$datos->idioma}}">
                    </td>
                    <td class=" bg-white col-md-5"> Requiere traductor
                        <input type="text" class="form-control" id="traductor" name="traductor" disabled value="{{$datos->traductor}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">8</td>
                    <td class=" bg-white col-md-5">¿Refugiado/a?
                        <input type="text" id="refugiado" name="refugiado" disabled value="{{$datos->refugiado}}">
                    </td>
                    <td class=" bg-white col-md-5" rowspan="2"> ¿Ha iniciado algún trámite para obtener esta
                        condición?
                        <input type="text" class="form-control" id="refugiado1" name="refugiado1" disabled value="{{$datos->tramite_condicion}}">
                    </td>
                </tr>
                <tr>
                    <td class="bg-white">¿Es asilado/a político/a?
                        <input type="text" id="asiladoSi" name="asilado" disabled value="{{$datos->asilado_politico}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="4" class="col-md-2" style="background-color: rgb(242, 245, 245)">9</td>
                    <td class=" bg-white col-md-5" colspan="2">¿Es defensor/a de derechos humanos?<br>
                        <input type="text" id="defensorSi" name="defensor" class="form-control" disabled value="{{$datos->defensor_dh}}"> 
                    </td>
                    <td class=" bg-white col-md-5" colspan="2"> ¿Pertenece a una institución?
                        <input type="text" id="institucionSi" name="institucion" class="form-control" disabled value="{{$datos->tiene_institucion}}">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class="bg-white co-md-12" colspan="4">
                        <p>¿Tipo de institución?</p>
                        <input type="text" class="form-control" disabled value="{{$datos->tipo_institucion}}">
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">10</td>
                    <td class=" bg-white col-md-5">¿Es periodista?
                        <input type="text" id="periodista" name="periodista" class="form-control" disabled value="{{$datos->periodista}}"> 
                    </td>
                    <td class=" bg-white col-md-5"> ¿Tipo de medio informativo??
                        <input type="text" class="form-control" id="medio_informativo" name="medio_informativo" disabled value="{{$datos->medio_informativo}}">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td colspan="2" class="bg-white">¿Nombre del medio informativo?
                        <input class="form-control" type="text" id="nombreMedio" name="nombreMedio" disabled value="{{$datos->nombre_medio}}">
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">11</td>
                    <td colspan="2" class="bg-white">¿Fue desplazado/a dentro del país o estado por condiciones de
                        violencia?
                        <input type="text" id="desplazado" name="desplazado" class="form-control" disabled value="{{$datos->desplazado}}">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class=" bg-white col-md-5">Entidad de salida
                        <input class="form-control" type="text" id="entidadSalida" name="entidadSalida" disabled value="{{$datos->entidad_salida}}">
                    </td>
                    <td class=" bg-white col-md-5"> Entidad receptora
                        <input type="text" class="form-control" id="entidadReceptora" name="entidadReceptora" disabled value="{{$datos->entidad_receptora}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">12</td>
                    <td class="bg-white col-md-10">Considera que el hecho victimizante se debió a: <br>
                        @foreach ($hechos as $hecho)
                        <input type="checkbox" id="religionCreencias" name="hecho" disabled checked> {{$hecho->tipo}} <br>  
                        @endforeach                       
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">13</td>
                    <td class="bg-white col-md-10">Información de violencia contra las mujeres: <br>
                        @foreach ($violenciaMujeres as $violencia)
                            <input type="checkbox" checked disabled id="vpsicologica" name="violencia" > {{$violencia->tipo}}  <br>
                        @endforeach
                        
                    </td>
                <tr class="col-md-12">
                    <td colspan="2" style="background-color: rgb(242, 245, 245)">
                        <p style="font-size: 12PX;">NOTA: El presente documento forma parte integral del Formato Único
                            de Declaración presentado
                            el {{$datos->fecha_doc}}
                            por {{$datos->presentadoPor}}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
 




