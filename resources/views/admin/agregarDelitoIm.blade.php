 <!-- VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS -->
 <div class="card text-white" style="background-color: rgb(139, 0, 69)">
    <center>
        <h6>VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</h6>
    </center><br>
    <center>
        DELITOS
    </center>
</div>
<form id="autMp" name="autMp" action="{{ route('guardar_delito_im') }}" method="post">
    @csrf
    <input type="hidden" id="id_im" name="id_im" value="{{ $id_im }}">
    <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
    <div class="form-row form-group">
        <div class=" col-md-6 border p-3">
            <label for="clasificacion">Clasificación</label>
                <select id="clasificacion" name="clasificacion" class="custom-select" onchange="BuscaDelito();">
                <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($delitos as $delito)
                    <option value="{{$delito->clasificacion}}" data-tipoa="{{$delito->clasificacion}}">{{$delito->clasificacion}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 border p-3  bg-white">
            <label for="delito">Delito</label>
            <select name="delito" id="delito" class="custom-select">
                <option disabled selected>Selecciona una opción [...]</option>
               
            </select>      
        </div>
        <div class=" col-md-6 border p-3 bg-white">
            <label for="danio">Tipo Daño</label>
            <select name="danio" id="danio" class="form-control">
                <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($danios as $danio)
                    <option value="{{$danio->id}}">{{$danio->danio}}</option>
                @endforeach
            </select>
        </div>
        <div class="border col-md-6 bg-white">
            <label for="observacion">Observacion</label>
            <textarea id="observacion" name="observacion" class="form-control" required></textarea>
        </div>
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-12">
            <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
        </div>
    </div>
</form>
<script>
function BuscaDelito() {
                var clasificacion = $("#clasificacion").find(':selected').data('tipoa');

                $.ajax({
                    type: "POST",
                    url: "/admin/muestraDelitos",
                    data: {
                        clasificacion: clasificacion,
                        mostrar: 'delito'
                    },
                    dataType: "html",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#delito').focus();
                        $("#delito").html(response);
                    }
                });
            }
</script>
    