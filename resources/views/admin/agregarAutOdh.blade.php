<!-- VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS -->
<div class="card text-white" style="background-color: #9D2449">
    <center>
        <h6>VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</h6>
    </center>
</div>
<form action="{{route('guardar_autoridad_odh')}}" method="POST">
    @csrf
    <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
    <div class="form-row>">
        <div class="col-md-12 border p-3 text-sm">
            <p><b> Procedimientos ante organismos nacionales e internacionales de Derechos Humanos</b></p>
        </div>
    </div>
    <div class="form-row">
        <div class=" col-md-9 border p-3 bg-white">
            <label for="pDh">¿Presentó queja, petición u otro tipo de solicitud ante organismo de DD. HH.?
            </label>&nbsp;&nbsp;
            <input type="radio" id="pDhSi" name="pDh"> Si&nbsp;&nbsp;
            <input type="radio" id="pDhNo" name="pDh"> No&nbsp;&nbsp;
        </div>
        <div class=" col-md-3 border p-3  bg-white">
            <label for="fechaPdh">Fecha</label>
            <input class="form-control" type="date" id="fechaPdh" name="fechaPdh">
        </div>
    </div>
    <div class="form-row">
        <div class=" col-md-6 border p-3 bg-white">
            <label for="competenciaDh">Competencia</label>&nbsp;&nbsp;
            <input type="radio" id="federalDh" name="competencia" value="Federal"> Federal&nbsp;&nbsp;
            <input type="radio" id="localDh" name="competencia" value="Local"> Local&nbsp;&nbsp;
            <input type="radio" id="internacionalDh" name="competencia" value="Internacional"> Internacional&nbsp;&nbsp;
        </div>
        <div class="col-md-6 border p-3 bg-white">
            <label for="organismoDh">Organismo</label>
            <input type="text" class="form-control" id="organismoDh" name="organismoDh">
        </div>
    </div>
    {{--<div class="form-row">
        <div class="col-md-12 border p-3 bg-white">
            <label for="violacionDh">Violación a DD. HH.</label>
            <input type="text" class="form-control" id="violacionDh" name="violacionDh">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 border p-3 bg-white">
            <label for="autRes">Autoridad responsable</label>
            <input type="text" class="form-control" id="autRes" name="autRes">
        </div>
    </div>--}}
    <div class="form-row">
        <div class=" col-md-12 border p-3 bg-white">
            <label for="tipoSol">Tipo de solución</label>&nbsp;&nbsp;
            <input type="radio" id="tipoSol1" name="tipoSol" value="Recomendacion" > Recomendación&nbsp;&nbsp;
            <input type="radio" id="tipoSol2" name="tipoSol" value="Conciliacion" > Conciliación&nbsp;&nbsp;
            <input type="radio" id="tipoSol3" name="tipoSol" value="Medidas precautorias" > Medidas precautorias&nbsp;&nbsp;
            <input type="radio" id="tipoSol4" name="tipoSol" onclick="HabilitaOtra();" > Otra
            <input type="text" id="otraSol" name="otraSol" class="form-control">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 border p-3 bg-white">
            <label for="folioDh">Folio</label>
            <input type="text" class="form-control" id="folioDh" name="folioDh">
        </div>
        <div class="col-md-6 border p-3 bg-white">
            <label for="edoDh">Estado actual</label>
            <input type="text" class="form-control" id="edoDh" name="edoDh">
        </div>
    </div>
   {{-- <div class="form-row">
        <div class="col-md-3 border p-3">
            <label for="otraAut">Otra autoridad</label>

        </div>
        <div class="col-md-9 border p-3 bg-white">
            <input type="text" class="form-control" id="otraAut" name="otraAut">
        </div>
    </div>--}}
    <div class="form-row">
        <div class="col-md-12 border p-3 bg-white text-xs">
            <p>NOTA: En caso de requerir más espacio para proporcionar información de este apartado, por favor utilice
                el
                formato “INFORMACIÓN COMPLEMENTARIA DE LA PERSONA VÍCTIMA”.</p>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
        </div>
    </div>
</form>
