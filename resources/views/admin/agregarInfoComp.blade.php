<!-- IX. Información complementaria de la persona víctima -->
<div class="card text-white" style="background-color: rgb(139, 0, 69)">
    <center>
        <h6>IX. INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA</h6>
    </center>
</div>
<form id="InfoComp" name="InfoComp" action="{{ route('guardar_infoComp') }}" onsubmit="return Validar();" method="POST">
    @csrf
    <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
    <input type="hidden" id="id_victima" name="id_victima" value="{{ $id_v }}">
    <div class="form-row">
        <div class="bg-white col-md-12 border p-3">
            <p class="text-sm text-justify"><b>La información contenida en el presente documento incluye datos
                    personales
                    sensibles por lo que estos serán tratados como confidenciales de conformidad con lo dispuesto en la
                    normatividad aplicable.</b></p>
        </div>
        <div class=" col-md-12 border p-3" style="background-color: rgb(242, 245, 245)">
            <p class="text-sm text-justify">El presente documento tiene la finalidad de conocer características
                particulares y condiciones que pudieran suponer mayor vulnerabilidad para las víctimas en razón de su
                edad,
                género, preferencia u orientación sexual, identidad o expresión de género, pertenencia a un pueblo o
                comunidad indígena, condición de discapacidad y otros para contar con información útil para brindar
                atención
                especializada.</p>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">1</td>
                    <td class=" bg-white col-md-5">¿Es niña/o o adolescente?&nbsp;&nbsp;
                        <input type="radio" id="ninaSi" name="nina" value="Si"> Si&nbsp;
                        <input type="radio" id="ninaNo" name="nina" value="No"> No
                    </td>
                    <td class=" bg-white col-md-5">Nombre del tutor/a
                        <input type="text" id="tutor" name="tutor" class="form-control">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td colspan="2" class=" bg-white col-md-10">Datos de contacto del tutor/a
                        <input type="text" id="contactoTutor" name="contactoTutor" class="form-control">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">2</td>
                    <td class=" bg-white col-md-5">¿Es persona adulta mayor?&nbsp;&nbsp;
                        <input type="radio" id="adultoSi" name="adulto" value="Si"> Si&nbsp;
                        <input type="radio" id="adultoNo" name="adulto" value="No"> No
                    </td>
                    <td class="col-md-1" style="background-color: rgb(242, 245, 245)">3</td>
                    <td class=" bg-white col-md-4">¿Se encuentra en situación de calle?&nbsp;&nbsp;
                        <input type="radio" id="calleSi" name="calle" value="Si"> Si&nbsp;
                        <input type="radio" id="calleNo" name="calle" value="No"> No
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="7" class="col-md-2" style="background-color: rgb(242, 245, 245)">4</td>
                    <td colspan="2" class=" bg-white col-md-10">¿Tiene condición de discapacidad?&nbsp;&nbsp;
                        <input type="radio" id="discapacidadSi" name="discapacidad" value="Si"> Si&nbsp;
                        <input type="radio" id="discapacidadNo" name="discapacidad" value="No"> No
                    </td>
                </tr>
                <tr class="col-md-12" style="background-color: rgb(242, 245, 245)">
                    <td class="col-md-3" align="center">Tipo</td>
                    <td class="col-md-7" align="center">Grado de dependencia</td>
                </tr>
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="radio" id="disFisica" name="disFisica" value="Fisica"> Fisica
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="radio" id="depModerada1" name="dependencia1" value="Moderada">
                            Moderada&nbsp;&nbsp;
                            <input type="radio" id="depSevera1" name="dependencia1" value="Severa">
                            Severa&nbsp;&nbsp;
                            <input type="radio" id="granDep1" name="dependencia1" value="GranDependencia"> Gran
                            dependencia&nbsp;&nbsp;
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="radio" id="disMental" name="disMental" value="Mental"> Mental
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="radio" id="depModerada2" name="dependencia2" value="Moderada">
                            Moderada&nbsp;&nbsp;
                            <input type="radio" id="depSevera2" name="dependencia2" value="Severa">
                            Severa&nbsp;&nbsp;
                            <input type="radio" id="granDep2" name="dependencia2" value="GranDependencia"> Gran
                            dependencia&nbsp;&nbsp;
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="radio" id="disIntelectual" name="disIntelectual" value="Intelectual">
                        Intelectual
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="radio" id="depModerada3" name="dependencia3" value="Moderada">
                            Moderada&nbsp;&nbsp;
                            <input type="radio" id="depSevera3" name="dependencia3" value="Severa">
                            Severa&nbsp;&nbsp;
                            <input type="radio" id="granDep3" name="dependencia3" value="GranDependencia"> Gran
                            dependencia&nbsp;&nbsp;
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="radio" id="disVisual" name="disVisual" value="Visual"> Visual
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="radio" id="depModerada4" name="dependencia4" value="Moderada">
                            Moderada&nbsp;&nbsp;
                            <input type="radio" id="depSevera4" name="dependencia4" value="Severa">
                            Severa&nbsp;&nbsp;
                            <input type="radio" id="granDep4" name="dependencia4" value="GranDependencia"> Gran
                            dependencia
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class=" bg-white col-md-3">
                        <input type="radio" id="disAuditiva" name="disAuditiva" value="Auditiva"> Auditiva
                    </td>
                    <td class="col-md-7">
                        <center>
                            <input type="radio" id="depModerada5" name="dependencia5" value="Moderada">
                            Moderada&nbsp;&nbsp;
                            <input type="radio" id="depSevera5" name="dependencia5" value="Severa">
                            Severa&nbsp;&nbsp;
                            <input type="radio" id="granDep5" name="dependencia5" value="GranDependencia"> Gran
                            dependencia&nbsp;&nbsp;
                        </center>
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">5</td>
                    <td class=" bg-white col-md-5">¿Pertenece a población/comunidad indígena?&nbsp;&nbsp;
                        <input type="radio" id="indigenaSi" name="indigena" value="Si"> Si&nbsp;
                        <input type="radio" id="indigenaNo" name="indigena" value="No"> No
                    </td>
                    <td class=" bg-white col-md-5"> ¿A cual?<br>
                        <select class="custom-select" name="pobIndigena" id="pobIndigena" required>
                            <option value="" selected>Selecciona una opción [...]</option>
                            @foreach ($etnias as $etnia)
                                <option value="{{ $etnia->grupo_etnico }}">{{ $etnia->grupo_etnico }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">6</td>
                    <td class=" bg-white col-md-3">¿Es migrante?&nbsp;&nbsp;
                        <input type="radio" id="migranteSi" name="migrante" value="Si"> Si&nbsp;
                        <input type="radio" id="migranteNo" name="migrante" value="No"> No
                    </td>
                    <td class=" bg-white col-md-3"> País de origen
                        <input type="text" class="form-control" id="paisOrigen" name="paisOrigen">
                    </td>
                    <td class=" bg-white col-md-3"> País de destino
                        <input type="text" class="form-control" id="paisDestino" name="paisDestino">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">7</td>
                    <td class=" bg-white col-md-5">¿Qué idioma habla?
                        <input type="text" id="idioma" name="idioma" class="form-control">
                    </td>
                    <td class=" bg-white col-md-5"> Requiere traductor
                        <input type="text" class="form-control" id="traductor" name="traductor">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">8</td>
                    <td class=" bg-white col-md-5">¿Refugiado/a?
                        <input type="radio" id="refugiadoSi" name="refugiado" value="Si"> Si&nbsp;
                        <input type="radio" id="refugiadoNo" name="refugiado" value="No"> No
                    </td>
                    <td class=" bg-white col-md-5" rowspan="2"> ¿Ha iniciado algún trámite para obtener esta
                        condición?
                        <input type="text" class="form-control" id="refugiado1" name="refugiado1">
                    </td>
                </tr>
                <tr>
                    <td class="bg-white">¿Es asilado/a político/a?
                        <input type="radio" id="asiladoSi" name="asilado" value="Si"> Si&nbsp;
                        <input type="radio" id="asiladoNo" name="asilado" value="No"> No
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="4" class="col-md-2" style="background-color: rgb(242, 245, 245)">9</td>
                    <td class=" bg-white col-md-5" colspan="2">¿Es defensor/a de derechos humanos?<br>
                        <input type="radio" id="defensorSi" name="defensor" value="Si"> Si&nbsp;
                        <input type="radio" id="defensorNo" name="defensor" value="No"> No
                    </td>
                    <td class=" bg-white col-md-5" colspan="2"> ¿Pertenece a una institución?
                        <input type="radio" id="institucionSi" name="institucion" value="Si"> Si&nbsp;
                        <input type="radio" id="institucionNo" name="institucion" value="No"> No
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class="bg-white co-md-12" colspan="4">
                        <p>¿Tipo de institución?</p>
                </tr>
                <tr class="bg-white">
                    <td><input type="radio" id="instFederal" name="inst" value="Federal"> Federal</td>
                    <td><input type="radio" id="instEstatal" name="inst" value="Estatal"> Estatal</td>
                    <td><input type="radio" id="instSc" name="inst" value="SociedadCivil"> Sociedad civil
                    </td>
                    <td rowspan="2"> Otra <input class="form-control" type="text" id="otraInst"
                            name="inst">
                    </td>
                </tr>
                <tr class="bg-white">
                    <td><input type="radio" id="instAp" name="inst" value="asistenciaPrivada"> Asistencia
                        privada</td>
                    <td><input type="radio" id="instRel" name="inst" value="religiosa"> Religiosa</td>
                    <td><input type="radio" id="instInter" name="inst" value="internacional"> Internacional
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">10</td>
                    <td class=" bg-white col-md-5">¿Es periodista?
                        <input type="radio" id="periodistaSi" name="periodista" value="Si"> Si&nbsp;
                        <input type="radio" id="periodistaNo" name="periodista" value="No"> No
                    </td>
                    <td class=" bg-white col-md-5"> ¿Tipo de medio informativo??
                        <input type="text" class="form-control" id="medio_informativo" name="medio_informativo">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td colspan="2" class="bg-white">¿Nombre del medio informativo?
                        <input class="form-control" type="text" id="nombreMedio" name="nombreMedio">
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">11</td>
                    <td colspan="2" class="bg-white">¿Fue desplazado/a dentro del país o estado por condiciones de
                        violencia?
                        <input type="radio" id="desplazadoSi" name="desplazado" value="Si"> Si&nbsp;
                        <input type="radio" id="desplazadoNo" name="desplazado" value="No"> No
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class=" bg-white col-md-5">Entidad de salida
                        <input class="form-control" type="text" id="entidadSalida" name="entidadSalida">
                    </td>
                    <td class=" bg-white col-md-5"> Entidad receptora
                        <input type="text" class="form-control" id="entidadReceptora" name="entidadReceptora">
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">12</td>
                    <td class="bg-white col-md-10">Considera que el hecho victimizante se debió a: <br>
                        <input type="checkbox" id="religionCreencias" name="hecho[]"
                            value="Religión o creencias"> Religión o
                        creencias&nbsp;
                        <input type="checkbox" id="preferenciaSexual" name="hecho[]"
                            value="Preferencia u orientación sexual">
                        Preferencia u
                        orientación
                        sexual
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class=" bg-white col-md-10">
                        <input type="checkbox" id="generoIde" name="hecho[]"
                            value="Identidad o expresión de género">
                        Identidad o expresión de género&nbsp;
                        <input type="checkbox" id="sexoIde" name="hecho[]" value="Sexo"> Sexo&nbsp;
                        <input type="checkbox" id="razaIde" name="hecho[]" value="Raza"> Raza&nbsp;
                        <input type="checkbox" id="otroIde" name="hecho[]" value="Otro"> Otro
                    </td>
                </tr>
            </table>
        </div>
        <div class=" col-md-12 border p-3">
            <table class="table table-bordered" class="col-md-12">
                <tr class="col-md-12">
                    <td rowspan="2" class="col-md-2" style="background-color: rgb(242, 245, 245)">13</td>
                    <td class="bg-white col-md-10">Información de violencia contra las mujeres: <br>
                        <input type="checkbox" id="vpsicologica" name="violencia[]" value="Psicologica">
                        Psicológica&nbsp;
                        <input type="checkbox" id="vFisica" name="violencia[]" value="Fisica"> Física&nbsp;
                        <input type="checkbox" id="vEconomica" name="violencia[]" value="Economica"> Ecónomica&nbsp;
                        <input type="checkbox" id="vPatrimonial" name="violencia[]" value="Patrimonial"> Patrimonial
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td class=" bg-white col-md-10">
                        <input type="checkbox" id="eGenero" name="violencia[]"
                            value="Identidad o expresión de género"> Identidad o expresión de género&nbsp;
                        <input type="checkbox" id="eSexual" name="violencia[]" value="Sexual"> Sexual&nbsp;
                        <input type="checkbox" id="eObstetrica" name="violencia[]" value="Obstétrica">
                        Obstétrica&nbsp;
                        <input type="checkbox" id="eFeminicida" name="violencia[]" value="Feminicida">
                        Feminicida<br>
                        <input type="checkbox" id="eOtro" name="eOtro"> Otro. <i>¿Cuál?</i>
                        <input type="text" class="form-control" id="otraViol" name="violencia[]">
                    </td>
                </tr>
                <tr class="col-md-12">
                    <td colspan="2" style="background-color: rgb(242, 245, 245)">
                        <p style="font-size: 12PX;">NOTA: El presente documento forma parte integral del Formato Único
                            de Declaración presentado
                            el
                            <input type="date" class="form-control col-md-3" id="fechaDoc" name="fechaDoc" required>
                            por <input class="form-control col-md-6" type="text" id="presentadoPor"
                                name="presentadoPor" required>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary" onclick="Validar();">Guardar</button>
        </div>
    </div>
</form>

<script>
  
    function Validar(){
     
        var nina = $("input[name='nina']:checked").length;
        var adulto = $("input[name='adulto']:checked").length;
        var calle = $("input[name='calle']:checked").length;
        var discapacidad = $("input[name='discapacidad']:checked").length;
        var disFisica = $("input[name='disFisica']:radio").is(':checked');
        var disMental = $("input[name='disMental']:radio").is(':checked');
        var disIntelectual = $("input[name='disIntelectual']:radio").is(':checked');
        var disVisual = $("input[name='disVisual']:radio").is(':checked');
        var disAuditiva = $("input[name='disAuditiva']:radio").is(':checked');
        var dependencia1 = $("input[name='dependencia1']:checked").length;
        var dependencia2 = $("input[name='dependencia2']:checked").length;
        var dependencia3 = $("input[name='dependencia3']:checked").length;
        var dependencia4 = $("input[name='dependencia4']:checked").length;
        var dependencia5 = $("input[name='dependencia5']:checked").length;
        var indigena = $("input[name='indigena']:checked").length;
        var migrante = $("input[name='migrante']:checked").length;
        var refugiado = $("input[name='refugiado']:checked").length;
        var asilado = $("input[name='asilado']:checked").length;
        var defensor = $("input[name='defensor']:checked").length;
        var institucion = $("input[name='institucion']:checked").length;
        var periodista = $("input[name='periodista']:checked").length;
        var desplazado = $("input[name='desplazado']:checked").length;

        //alert(nina+","+adulto+","+calle+","+discapacidad+","+indigena+","+migrante+","+refugiado+","+asilado+","+defensor+","+institucion+","+periodista+","+desplazado);

    

        if (nina == 0) {
            alert("¡Selecciona el valor que corresponde a si es niña o adolesccente!");
            $("#ninaSi").focus();
                return false;              
        }else if(adulto == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es adulto mayor o no!");
            $("#adultoSi").focus();
                return false;    
        }else if(calle == 0)
        {
            alert("¡Selecciona el valor que corresponde a si se encuentra en situación de calle o no!");
            $("#calleSi").focus();
                return false;   
        }else if(discapacidad == 0)
        {
            alert("¡Selecciona el valor que corresponde a si tiene alguna discapacidad o no!");
            $("#discapacidadSi").focus();
                return false;    
        }else if(indigena == 0)
        {
            alert("¡Selecciona el valor que corresponde a si pertenece a una etnia o no!");
            $("#indigenaSi").focus();
                return false;
        }else if(migrante == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es migrante o no!");
            $("#migranteSi").focus();
                return false;
        }else if(refugiado == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es refugiado(a) o no!");
            $("#refugiadoSi").focus();
                return false;
        }else if(asilado == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es asilado(a) o no!");
            $("#asiladoSi").focus();
                return false;
        }else if(defensor == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es defensor(a) de DH o no!");
            $("#defensorSi").focus();
                return false;
        }else if(institucion == 0)
        {
            alert("¡Selecciona el valor que corresponde a si pertenece a una institucion de DH o no!");
            $("#institucionSi").focus();
                return false;
        }else if(periodista == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es periodista o no!");
            $("#periodistaSi").focus();
                return false;
        }else if(desplazado == 0)
        {
            alert("¡Selecciona el valor que corresponde a si es desplazado(a) o no!");
            $("#desplazadoSi").focus();
                return false;
        }
        else if (disFisica == true && dependencia1 == 0) {
            alert("¡Escoge un valor para el grado de dependencia!");
            $("#depModerada1").focus();
                return false;              
        }

        else if (disMental == true && dependencia2 == 0) {
            alert("¡Escoge un valor para el grado de dependencia!");
            $("#depModerada2").focus();
                return false;              
        }

        else if (disIntelectual == true && dependencia3 == 0) {
            alert("¡Escoge un valor para el grado de dependencia!");
            $("#depModerada3").focus();
                return false;              
        }

        else if (disVisual == true && dependencia4 == 0) {
            alert("¡Escoge un valor para el grado de dependencia!");
            $("#depModerada4").focus();
                return false;              
        }

        else if (disAuditiva == true && dependencia5 == 0) {
            alert("¡Escoge un valor para el grado de dependencia!");
            $("#depModerada5").focus();
                return false;              
        }
        
        else{
            return true;
        }
    }

   
</script>
