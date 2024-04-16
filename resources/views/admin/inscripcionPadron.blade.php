<div>
    <form id="inscripcionPadron" name="inscripcionPadron" action="{{ route('guardar_inscripcionPadron') }}" method="POST">
        @csrf
        <input type="hidden" id="id_fud" name="id_fud" value="{{$id_fud}}">
        <input type="hidden" id="id_u" name="id_u" value="{{ auth()->id() }}">
        <div class="form-row">
        <div class="h2 p-3">¿Estas seguro(a) de inscribir el registro actual al Padrón?</div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 p-3">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>"
                    required />

            </div>
            <div class="col-md-4 p-3">
                <label for="tipo_victima">Tipo Víctima</label>
                <select name="tipo_victima" id="tipo_victima" required class="custom-select">
                    <option value="" selected disabled>Selecciona una opción [...]</option>
                    <option value="Directa">Directa</option>
                    <option value="Indirecta">Indirecta</option>
                    <option value="Potencial">Potencial</option>
                </select>
            </div>
            <div class="col-md-4 p-3">
                <label for="tipo_danio">Tipo de daño</label>
                <select name="tipo_danio" id="tipo_danio" required class="custom-select">
                    <option value="" selected disabled>Selecciona una opción [...]</option>
                    <option value="Delito">Delito</option>
                    <option value="DH">Violacion a DH</option>
                    <option value="Ambos">Ambos</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 p-3">
                <center>
                    <button type="submit" name="si" class="btn btn-md btn-success" value="Si">Si</button>
                </center>
            </div>
            <div class="form-group col-md-6 p-3">
            <center>
                <button type="button" onclick="Cerrar();" class="btn btn-md btn-success">No</button>
            </center>
            </div>
        </div>
    </form>
</div>
<script>
    function Cerrar()
    { 
        location.reload();
    }
</script>