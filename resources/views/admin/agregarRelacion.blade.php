
<div class="card text-white" style="background-color: #9D2449">
    <center>
        <h6>III. RELACIÓN DE LA VÍCTIMA INDIRECTA CON LA VÍCTIMA DIRECTA</h6>
    </center>
</div>
<form id="relacionVic" name="relacionVic" action="{{route('guardar_relacion_victima')}}" method="post">
    @csrf
    <input type="hidden" id="id_fud" name="id_fud" value="{{$id_fud}}">
    <input type="hidden" id="id_v" name="id_v" value="{{$id_v}}">
<table class="table table-bordered">
    <thead style="background-color: rgb(233, 232, 232)">
        <tr>
            <td>En caso de ser víctima indirecta, proporcione nombre completo de la víctima directa</td>
            <td>Relación con la víctima directa. Conteste: <br><i>¿Qué soy de la víctima directa?</i></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >{{-- Se muestran solo las victimas activas en el padron--}}
                <select class="form-control relacion" style="width: 90%" id="victima" name="victima" required>
                    <option value="" disabled selected>Selecciona una opcion [...]</option>
                    @foreach ($victimas as $victima)
                    <option value="{{$victima->id}}">{{$victima->nombre_victima}}</option> 
                    @endforeach
                </select>
            </td>
            <td >
                <select class=" custom-select " style="width: 90%" id="relacion" name="relacion" required>
                    <option value="" disabled selected>Selecciona una opcion [...]</option>
                   @foreach ($relaciones as $relacion)
                   <option value="{{$relacion->id}}">{{$relacion->relacion}}</option>
                   @endforeach
                </select>
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

@section('js')
<script>
$(document).ready(function() {
    $('.relacion').select2({
        placeholder: 'Introduce un nombre'
    });
});
</script>
