 <!-- OBSERVACIONES Y COMPARTIR DATOS -->
 <div class="card text-white" style="background-color: rgb(139, 0, 69)">
     <center>
         <h6>X. MÁS INFORMACIÓN</h6>
     </center>
 </div>
 <div class="card-body">
     <form id="masInfo" name="masInfo" action="{{ route('guardarMasInformacion') }}" method="POST">
         @csrf
         <input type="hidden" id="id_fud" name="id_fud" value="{{ $id_fud }}">
         <input type="hidden" id="id_victima" name="id_victima" value="{{ $id_v }}">
         <div class="form-row">
             <div class="form-group col-md-12">
                 <label for="observaciones">Aquí puedes agregar más información</label>
                 <textarea class="form-control" name="observaciones" id="observaciones" rows="12" required></textarea>
             </div>
             <div class="form-group col-md-12">
                 <div class="col-lg-12 text-center">
                     <button type="submit" class="btn btn-primary">Guardar</button>
                 </div>
             </div>
         </div>
     </form>
 </div>
