<!-- V. LUGAR Y FECHA DE LOS HECHOS -->
<div class="card text-white" style="background-color: #9D2449">
    <center>
        <h6>V. LUGAR Y FECHA DE LOS HECHOS</h6>
    </center>
</div>
<form id="lugarHechos" name="lugarHechos" action="{{route('guardar_lugar_hechos')}}" method="post">
    @csrf
    <input type="hidden" id="id_fud" name="id_fud" value="{{$id_fud}}">
    
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="calle">Calle</label>
        <input type="text" class="form-control" id="calle" name="calle" required />

    </div>
    <div class="form-group col-md-3">
        <label for="numExtVic">No. Exterior</label>
        <input type="number" class="form-control" id="numExtVic" name="numExtVic" />
    </div>
    <div class="form-group col-md-3">
        <label for="numIntVic">No. Interior</label>
        <input type="number" class="form-control" id="numIntVic" name="numIntVic" />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="cpHechos">Codigo Postal</label>
        <input type="number" class="form-control" id="cpHechos" name="cpHechos" />

    </div>
    <div class="form-group col-md-9">
        <label for="coloniaHechos">Colonia</label>
        <input type="text" class="form-control" id="coloniaHechos" name="coloniaHechos" />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="entidadFedHechos">Entidad Federativa</label>
        <select id="entidadFedHechos" name="entidadFedHechos" class="custom-select">
            <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($ent_federativas as $ent_federativa)
                <option value="{{ $ent_federativa->id }}">{{ $ent_federativa->estado }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="municipioHechos">Municipio</label>
        <select id="municipioHechos" name="municipioHechos" class="custom-select" onchange="BuscaLocalidad()"
        required>
        <option disabled selected>Selecciona una opción [...]</option>
        @foreach ($municipios as $municipio)
            <option value="{{ $municipio->id }}" data-tipoa="{{ $municipio->id }}">
                {{ $municipio->municipio }}</option>
        @endforeach
    </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-9">
        <label for="localidadHechos">Localidad</label>
        <select id="localidadHechos" name="localidadHechos" class="custom-select">
            <option disabled selected>Selecciona una opción [...]</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="fechaHechos">Fecha</label>
        <input type="date" class="form-control" id="fechaHechos" name="fechaHechos" />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <textarea class="form-control text-xs text-justify" cols="3" rows="5" disabled>En caso de no conocer todos los datos sobre el lugar donde ocurrieron los hechos victimizantes, favor de proporcionar los que conozca y utilice esta casilla para agregar otros datos de ubicación</textarea>
    </div>
    <div class="form-group col-md-9">
        <textarea class="form-control" cols="6" rows="4" id="otrosDatos" name="otrosDatos"></textarea>
    </div>
</div>
<div class="card bg-gray">
    <center><span><b>Relato de los hechos</b></span></center>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <p class="bg-white text-xs text-justify">Por favor relate las circunstancias de modo, tiempo y lugar, antes,
            durante y después de los hechos victimizantes. En caso de contar con alguna constancia o documento
            ministerial, jurisdiccional o de organismos nacionales o internacionales de derechos humanos en donde se dé
            cuenta del mismo, anexarlo al presente formato. En caso de que los hechos victimizantes atenten contra
            derechos colectivos, favor de referirlo.</p>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <textarea class="form-control" cols="12" rows="8" id="relato" name="relato"></textarea>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <p class="bg-white text-xs text-justify">Acontinuación describa brevemente el daño sufrido.</p>
    </div>
    <div class="form-group col-md-12">
        <textarea class="form-control" cols="12" rows="4" id="descDanio" name="descDanio"></textarea>
    </div>
</div>
<div class="form-row"> 
    <div class="form-group col-md-12">
        <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
    </div>
</div>
</form>

<script>
     function BuscaLocalidad() {
                var id_municipio = $("#municipioHechos").find(':selected').data('tipoa');

                $.ajax({
                    type: "POST",
                    url: "/admin/muestraLocalidades",
                    data: {
                        id_municipio: id_municipio,
                        mostrar: 'localidad'
                    },
                    dataType: "html",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#localidadHechos').focus();
                        $("#localidadHechos").html(response);
                    }
                });
            }
</script>
