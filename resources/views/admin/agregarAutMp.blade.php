 <!-- VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS -->
 <div class="card text-white" style="background-color: #9D2449">
     <center>
         <h6>VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</h6>
     </center>
 </div>
 <form id="autMp" name="autMp" action="{{ route('guardar_autoridad_mp') }}" method="post">
     @csrf
     <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
     <div class="form-row form-group">
         <div class=" col-md-4 border p-3">
             <p class=" text-justify"><b>Investigación ministerial</b></p>
         </div>
         <div class="col-md-5 border bg-white p-3">¿Denunció ante el ministerio Público?<br>
             <input type="radio" id="Si1" name="SiDenuncio" value="Si"> Si&nbsp;&nbsp;
             <input type="radio" id="No2" name="SiDenuncio" value="No"> No&nbsp;&nbsp;
         </div>
         <div class=" col-md-3 border p-3  bg-white">
             <label for="fechaMinisterial">Fecha</label>
             <input class="form-control" type="date" id="fechaMinisterial" name="fechaMinisterial">
         </div>
         <div class=" col-md-6 border p-3 bg-white">
             <label for="competencia">Competencia</label>&nbsp;&nbsp;
             <input type="radio" id="federal" name="competencia" value="Federal"> Federal&nbsp;&nbsp;
             <input type="radio" id="local" name="competencia" value="Local"> Local&nbsp;&nbsp;
         </div>
         <div class="border col-md-6 bg-white">
             <label for="entidadFed">Entidad Federativa</label>
             <select id="entidadFed" name="entidadFed" class="custom-select" required>
                 <option disabled selected>Selecciona una opción [...]</option>
                 @foreach ($ent_federativas as $ent_federativa)
                     <option value="{{$ent_federativa->id}}">{{$ent_federativa->estado}}</option>
                 @endforeach
             </select>
         </div>
        
         <div class=" col-md-12 border p-3 bg-white">
             <label for="agenciaMp">Agencia del ministerio público</label>&nbsp;&nbsp;
             <input type="text" class="form-control" id="agenciaMp" name="agenciaMp">
         </div>
         <div class=" col-md-4 border p-3 bg-white">
             <label for="apciac">A. P.***</label>
             <input type="text" class="form-control" id="ap" name="ap"><br>
         </div>
         <div class=" col-md-4 border p-3 bg-white">
             <label for="apciac">C. I.***</label>
             <input type="text" class="form-control" id="apciac" name="ci"><br>
         </div>
         <div class=" col-md-4 border p-3 bg-white">
             <label for="apciac">A. C.***</label>
             <input type="text" class="form-control" id="apciac" name="ac"><br>
         </div>
         <div class=" col-md-12 border p-3 bg-white">
             <label for="edoInv">Estado de la Investigación</label>&nbsp;&nbsp;
             <input type="text" class="form-control" id="edoInv" name="edoInv">
         </div>
         <div class="col-md-12 border p-3 bg-white text-xs">
             <p style="text-align: right;"> *** A. P. = Averiguación previa; C. I.= Carpeta de investigación, y A. C. =
                 Acta circunstanciada</p>
         </div>
     </div>
     <div class="form-row"> 
        <div class="form-group col-md-12">
            <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
        </div>
    </div>
 </form>

 @section('js')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Selecciona una opción [. . .]'
    });
});
</script>
