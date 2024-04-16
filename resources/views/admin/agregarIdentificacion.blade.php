<!-- IV. IDENTIFICACIÓN DE LA VÍCTIMA -->
<div class="card text-white" style="background-color:  #9D2449">
    <center><h6>IV. IDENTIFICACIÓN DE LA VÍCTIMA</h6></center>     
    </div>
    <form id="ideVic" name="ideVic" action="{{route('guardar_identificacion_victima')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" id="id_v" name="id_v" value="{{$id_v}}">
        <input type="hidden" id="id_fud" name="id_fud" value="{{$id_fud}}">
    <table class="table table-bordered">
    <thead style="background-color: rgb(233, 232, 232)">
        <tr>
            <td colspan="2">Se deberá anexar al presente Formato, copia de la identificación de la víctima. En caso de manifestar no contar con ella en este momento, la identificación deberá ser remitida a la Comisión Ejecutiva Estatal de Atención Integral a Víctimas con posterioridad.</td>
            <td colspan="1">¿Presenta identificación? <br>
                <label><input  type="radio" value="Si" name="valor"> Si</label><br>
                <label><input  type="radio" value="No" name="valor"> No</label>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >
                <input type="radio"  value="1" name="ide"> Credencial de elector
            </td>
            <td>
                <input type="radio"  value="2" name="ide"> Pasaporte
            </td>
            <td>
                <input type="radio"  value="3" name="ide"> Cartilla del servicio militar
            </td>
        </tr>
        <tr>
            <td >
                <input type="radio"  value="4" name="ide"> Credencial oficial expedida por el IMSS o ISSSTE
            </td>
            <td>
                <input type="radio"  value="5" name="ide"> Certificado o constancia de estudios
            </td>
            <td>
                <input type="radio"  value="6" name="ide"> Cédula profesional
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio"  value="7" name="ide"> Otro documento oficial
            </td>
            <td colspan="2">
                <input type="text" class="form-control" id="otroDoc" name="otroDoc" placeholder="Especifique otro documento" value="" > 
            </td>
        </tr>
        <tr>
            <td colspan="1">Numero de documento probatorio</td>
            <td colspan="2">
                <input type="text" class="form-control" id="doc_probatorio" name="doc_probatorio" required>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="card m-b-30">                 
                              <div class="fallback" style="background-color: #ffe3b9;">
                              <label for="escaneo">Adjuntar archivo de identificación</label> <br>
                                <input class="btn btn-md" id="escaneo" name="escaneo" type="file" required  >
                              </div>     
                        </div>
                      </div>
                    </div> 
            </td>
        </tr>
    </tbody>
    </table>
    <div class="form-row"> 
        <div class="form-group col-md-12">
            <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
        </div>
    </div>
    </form>

    <script>   

    $(document).ready(function() {

    $('#ideVic').submit(function(event) {
        // Prevenir el envío del formulario para poder realizar el conteo primero
        event.preventDefault();

        // Nombre de los radios
        var ideRadio = 'ide';
        var valor = $('input[name=valor]:checked', '#ideVic').val();
        // Contar la cantidad de radios con el mismo nombre checados
        var cantidadChecados = $('input[name="' + ideRadio + '"]:checked').length;

        // Mostrar la cantidad de radios checados en la consola
       // alert(cantidadChecados); 
            if (valor == 'Si' && cantidadChecados == 1) {
                this.submit(); // Envía el formulario        
            }else{
                alert("Por favor, seleccione al menos una opción para el tipo de Identificación.");
            return false; // Evita el envío del formulario
            } 
        
    });
});
 
$('#ideVic input').on('change', function() {
var valor = $('input[name=valor]:checked', '#ideVic').val();
        if (valor=='No') {
            location.reload();  
        }
    });
        
         $('input[type="file"]').on('change', function(){
           var ext = $( this ).val().split('.').pop();
           if ($( this ).val() != '') {
             if(ext == "pdf"){
             
               if($(this)[0].files[0].size > 5000000){
                 alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");
                         
                 $(this).val('');
               }
             }
             else
             {
               $( this ).val('');
               alert("Extensión no permitida: " + ext);
             }
           }
         });
        
        
        </script>