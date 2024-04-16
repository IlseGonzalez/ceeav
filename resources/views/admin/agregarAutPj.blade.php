 <!-- VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS -->
 <div class="card text-white" style="background-color: #9D2449">
    <center>
        <h6>VII. AUTORIDADES QUE HAN CONOCIDO DE LOS HECHOS</h6>
    </center>
</div>
<form action="{{route('guardar_autoridad_pj')}}" method="post">
    @csrf
    <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
<div class="form-row">
    <div class=" col-md-6 border p-3">
        Proceso Judicial
    </div>
    <div class=" col-md-6 border p-3  bg-white" >
        <label for="fechaIniPj">Fecha de inicio del proceso Judicial</label>
            <input class="form-control" type="date" id="fechaIniPj" name="fechaIniPj" >    
    </div>
    <div class=" col-md-6 border p-3 bg-white">
        <label for="competenciaPj">Competencia</label>&nbsp;&nbsp;
        <input type="radio" id="federalPj" name="competencia" value="Federal"> Federal&nbsp;&nbsp;
        <input type="radio" id="localPj" name="competencia" value="Local"> Local&nbsp;&nbsp;
    </div>
    <div class="border col-md-6 bg-white">
        <label for="entidadFedPj">Entidad Federativa</label>
            <select id="entidadFedPj" name="entidadFedPj" class="custom-select" required>
                <option disabled selected>Selecciona una opción [...]</option>
                @foreach ($ent_federativas as $ent_federativa)
                    <option value="{{$ent_federativa->id}}">{{$ent_federativa->estado}}</option>
                @endforeach
             </select>
    </div>
   {{--}} <div class=" col-md-12 border p-3 bg-white">
        <label for="delitoPj">Delito</label>&nbsp;&nbsp;
        <input type="text" class="form-control" id="delitoPj" name="delitoPj">
    </div>--}}
    <div class=" col-md-8 border p-3 bg-white">
        <label for="numJuzgadoPj">Número de Juzgado</label>&nbsp;&nbsp;
       {{-- <input type="text" class="form-control" id="numJuzgadoPj" name="numJuzgadoPj">--}}
        <select name="numJuzgadoPj" id="numJuzgadoPj" class="form-control">
            <option value="" selected disabled>Escoge una opcion[...]</option>
            @php
            for ($i=1;$i<=10;$i++)   { 
                $tipoJuzgados =   ${'tipoJuzgados'.$i};
            @endphp
                <optgroup label="{{ $tipoJuzgados->tipo }}"> 
                    @foreach (${'juzgado'.$i} as $juzgado)
                        <option value="">{{$juzgado->juzgado}}</option>
                    @endforeach       
                </optgroup>
            @php
                }
            @endphp
        </select>
    </div>
    <div class=" col-md-4 border p-3 bg-white">
        <label for="numProcesoPj">Número de Proceso</label>
        <input type="text" class="form-control" id="numProcesoPj" name="numProcesoPj">
    </div>
    <div class=" col-md-12 border p-3 bg-white">
        <label for="edoPj">Estado del Proceso judicial</label>
        <input type="text" class="form-control" id="edoPj" name="edoPj">
    </div>
</div>
<div class="form-row"> 
    <div class="form-group col-md-12">
        <center><button type="submit" class="btn btn-info btn-md">Guardar</button></center>
    </div>
</div>
</form>
