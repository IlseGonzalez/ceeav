<!-- VIII. HOJA DE FIRMAS -->
<div class="card text-white" style="background-color: rgb(139, 0, 69)">
    <center>
        <h6>VIII. HOJA DE FIRMAS</h6>
    </center>
</div>
<div class="bg-white col-md-12 border">
    <label>LA PRESENTE SOLICITUD DE REGISTRO SE SUSCRIBE POR:</label>
</div>
<form id="hojaFirmas" name="hojaFirmas" action="{{ route('guardar_hoja') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="id_fud" id="id_fud" value="{{ $id_fud }}">
    <input type="hidden" id="id_u" name="id_u" value="{{ auth()->id() }}">
    <div class="bg-white col-md-12 border p-3">
        <input type="radio" id="suscriptor1" name="suscriptor" value="Víctima Directa, Indirecta o Potencial">&nbsp;
        <label class="border text-white" style="background-color: rgb(139, 0, 69)">&nbsp;&nbsp;A&nbsp;&nbsp;
        </label>&nbsp;&nbsp;&nbsp;
        <label>Víctima Directa, Indirecta o
            Potencial</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="suscriptor2" name="suscriptor" value="Familiar o persona de confianza">&nbsp;
        <label class="border text-white" style="background-color: rgb(139, 0, 69)">&nbsp;&nbsp;B&nbsp;&nbsp;
        </label>&nbsp;&nbsp;&nbsp;
        <label>Familiar o persona de confianza</label>
    </div>
    <div class="bg-white col-md-12 border">
        <label>NOMBRE COMPLETO</label>
        <input type="text" class="form-control" id="ncompletoVic" name="ncompletoVic">
    </div>
    <div class="form-row">
        <div class="col-md-6 border p-3 bg-white text-center">
            <label for="firmaSusc" class="text-xs">FIRMA</label><br>
            <input id="firmaSusc" name="firmaSusc" type="file" class="btn btn-sm">
        </div>
        <div class="col-md-6 border p-3 bg-white text-center">
            <label for="edoDh" class="text-xs">HUELLAS DACTILARES DEL/LA SOLICITANTE</label><br>
            <input id="huellaSusc" name="huellaSusc" type="file" class="btn btn-sm">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 border p-3 bg-white">
            <label for="" class="text-xs">Opcional.
                Manifiesto expresamente mi deseo de recibir cualquier tipo
                de notificación relacionada con el presente FUD en el
                siguiente correo electrónico:</label>
            <input type="text" class="form-control" id="emailNotificacion" name="emailNotificacion">
        </div>
        <div class="col-md-12 border p-3 bg-white">
            <input type="radio" id="noFirma" name="noFirma" value="NoFirma"> <label for="noFirma"
                class="text-xs">Una vez que me fue leído el
                contenido del presente FUD, manifiesto no poder o saber
                firmar por lo que sólo imprimo mis huellas dactilares</label>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 border p-3 bg-white text-center">
            <input type="file" class="btn btn-sm" id="manoIzq" name="manoIzq">
            <br><label for="manoIzq" class="text-xs">Mano izquierda</label>
        </div>
        <div class="col-md-6 border p-3 bg-white text-center">
            <input type="file" class="btn btn-md" id="manoDer" name="manoDer">
            <br><label for="manoDer" class="text-xs">Mano derecha</label>
        </div>
        <div class=" col-md-12 border text-center">
            <p>Huella dactilar de índice o pulgar</p>
        </div>
    </div>
    <div class="form-row">
        <div class="bg-white col-md-12 border p-3">
            <input type="radio" id="suscriptor3" name="suscriptor" value="Servidor/a público/a o autoridad">&nbsp;
            <label class="border text-white" style="background-color: rgb(139, 0, 69)">&nbsp;&nbsp;C&nbsp;&nbsp;
            </label>&nbsp;&nbsp;&nbsp;
            <label>Servidor/a público/a o autoridad</label>
        </div>
        <div class="bg-white col-md-6 border p-3">
            <label for="ncompletoAut">NOMBRE COMPLETO</label>
            <input type="text" class="form-control" id="ncompletoAut" name="ncompletoAut">
        </div>
        <div class="bg-white col-md-6 border p-3">
            <label for="cargoAut">CARGO</label>
            <input type="text" class="form-control" id="cargoAut" name="cargoAut">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 border p-3 bg-white text-center">
            <input type="file" class="btn btn-sm" id="firmaAut" name="firmaAut">
            <br><label for="firmaAut" class="text-xs">FIRMA</label>
        </div>
        <div class="col-md-6 border p-3 bg-white text-center">
            <input type="file" class="btn btn-sm" id="selloAut" name="selloAut">
            <br><label for="selloAut" class="text-xs">SELLO</label>
        </div>
        <div class=" col-md-12 border text-right">
            <p>Sello de la dependencia o institución</p>
        </div>
    </div>
    <div class="form-row">
        <div class="bg-white col-md-12 border p-3">
            <input type="radio" id="suscriptor4" name="suscriptor"
                value="Representante legal de la víctima">&nbsp;
            <label class="border text-white" style="background-color: rgb(139, 0, 69)">&nbsp;&nbsp;D&nbsp;&nbsp;
            </label>&nbsp;&nbsp;&nbsp;
            <label>Representante legal de la víctima</label>
        </div>
        <div class="bg-white col-md-6 border p-3">
            <label for="ncompletoRep">NOMBRE COMPLETO</label>
            <input type="text" class="form-control" id="ncompletoRep" name="ncompletoRep">
            <br>
            <label for="cargoRep">CARGO</label>
            <input type="text" class="form-control" id="cargoRep" name="cargoRep">
            <br>
            <input type="file" class="btn btn-sm" id="firmaRep" name="firmaRep">
            <br><label for="firmaRep" class="text-xs">FIRMA</label>
        </div>
        <div class="bg-white col-md-6 border p-3">
            <p class="text-justify"><b>Nota:</b> En caso de solicitudes presentadas por representantes legales de las
                víctimas, autorizados en términos del artículo 97, fracción I de la Ley General de Víctimas, se deberá
                anexar a la presente solicitud el Anexo Único “Formato de Inscripción en el Padrón de Representantes
                (FIPRE)”.</label>
        </div>
    </div>
    <div class="form-row">
        <div class="bg-white col-md-12 border p-3">
            <p class="text-sm text-center">El presente Formato Único de Declaración se requisitó / completó con el
                apoyo de
                personal de la CEEAV que se detalla a continuación:</p>
        </div>
        <div class="bg-white col-md-6 border p-3">
            <label for="ncompletoCeeav" class="text-xs">NOMBRE COMPLETO</label>
            <input type="text" class="form-control" id="ncompletoCeeav" name="ncompletoCeeav">
            <br>
            <label for="cargoRep" class="text-xs">CARGO</label>
            <input type="text" class="form-control" id="cargoRepCeeav" name="cargoRepCeeav">
            <br>
            <input type="file" class="btn btn-sm" id="firmaRepCeeav" name="firmaRepCeeav">
            <br><label for="firmaRepCeeav" class="text-xs">FIRMA</label>
            <hr>
            <label for="ncompletoCeeav2" class="text-xs">NOMBRE COMPLETO</label>
            <input type="text" class="form-control" id="ncompletoCeeav2" name="ncompletoCeeav2">
            <br>
            <label for="cargoRepCeeav2" class="text-xs">CARGO</label>
            <input type="text" class="form-control" id="cargoRepCeeav2" name="cargoRepCeeav2">
            <br>
            <input type="file" class="btn btn-sm" id="firmaRepCeeav2" name="firmaRepCeeav2">
            <br><label for="firmaRepCeeav2" class="text-xs">FIRMA</label>
        </div>
        <div class="bg-white col-md-6 border text-center p-3 ">
            <input id="selloCeeav" name="selloCeeav" type="file" class="btn btn-sm">
            <br><label for="" class="text-xs">Sello de la CEEAV</label>

        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

<script>
   
    $('#hojaFirmas input').on('change', function() {
        var valor = $('input[name=suscriptor]:checked', '#hojaFirmas').val();
        //alert(valor);
        if (valor == 'Víctima Directa, Indirecta o Potencial' || valor == 'Familiar o persona de confianza') 
        {
            $('#ncompletoVic').prop('required', true);
            var nofirma=$('input[name="noFirma"]:checked','#hojaFirmas').val();
            //alert(nofirma);
                if(nofirma == 'noFirma')//si el radio esta checkado sera obligatorio subir las huellas de la mano izq y der
                {
                    /*Valida subida de archivo del boton manoIzq*/
                    $('#manoIzq').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
                        /*Valida subida de archivo del boton manoDer*/
                    $('#manoDer').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
                }else{
                    /*Valida subida de archivo del boton firmaSusc*/
                    $('#firmaSusc').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
                        /*Valida subida de archivo del boton huellaSusc*/
                    $('#huellaSusc').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });

                }

                
        } 
        else if(valor == 'Servidor/a público/a o autoridad')
        {
            $('#ncompletoAut').prop('required', true);
            $('#cargoAut').prop('required', true);
             /*Valida subida de archivo del boton firmaAut*/
            $('#firmaAut').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
                    /*Valida subida de archivo del boton selloAut*/
                    $('#selloAut').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
        }
        else if(valor == 'Representante legal de la víctima')
        {
            $('#ncompletoRep').prop('required', true);
            $('#cargoRep').prop('required', true);
            /*Valida subida de archivo del boton selloAut*/
            $('#firmaRep').on('change', function() 
                    {
                        var ext = $(this).val().split('.').pop();
                        if ($(this).val() != '') 
                        {
                            if (ext == "pdf") 
                            {
                                if ($(this)[0].files[0].size > 5000000) 
                                {alert("Se solicita un archivo no mayor a 5MB. Por favor verifica.");$(this).val('');
                                }
                            } else { $(this).val('');alert("Extensión no permitida: " + ext); }
                        }
                    });
        }


    });
</script>
