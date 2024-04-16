
<!-- VII. VIOLACIONES COMETIDAS POR AUTORIDADES -->
<div class="card text-white" style="background-color: #9D2449">
    <center>
        <h6>VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</h6>
    </center>
</div>
<form id="autV" name="autV" action="{{ route('guardar_violaciones') }}" method="post">
    @csrf
    <input type="hidden" id="id_odh" name="id_odh" value="{{ $id_odh }}">
    <input type="hidden" id="id_u" name="id_u" value="{{ auth()->id() }}">
    <div class="form-row form-group"> 
        <div class="border col-md-12 p-3 bg-white">
            <label for="violacion">Violación</label>
            <select id="violacion" name="violacion" class="custom-select" required>
                <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($violaciones as $violacion)
                    <option value="{{$violacion->id}}">{{$violacion->derecho_violado}}</option>
                @endforeach
            </select>
        </div>
        <div class="border col-md-12 p-3 bg-white">
            <label for="dependencia">Dependencia</label>
            <select id="dependencia" name="dependencia" class="custom-select select2" required style="width: 100%">
                <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($dependencias as $dependencia)
                    <option value="{{$dependencia->id}}">{{$dependencia->nom_dependencia}}</option>
                @endforeach
            </select>
        </div>
       
        <div class=" col-md-6 border p-3 bg-white">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo">
        </div>
        <div class=" col-md-6 border p-3 bg-white">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"><br>
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
