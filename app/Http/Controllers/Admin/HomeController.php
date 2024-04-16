<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatDelito;
use App\Models\CatEdoCivil;
use App\Models\CatEntFederativa;
use App\Models\CatMunicipio;
use App\Models\CatPaises;
use App\Models\CatTipoSolicitante;
use App\Models\CatTipoVictima;
use App\Models\DatosIdentificacion;
use App\Models\DatoSolicitante;
use App\Models\DatosVictima;
use App\Models\Dependencia;
use App\Models\FormulariosFud;
use App\Models\HistorialDelitoIm;
use App\Models\HistorialDelitoPj;
use App\Models\HistorialDiscapacidad;
use App\Models\HistorialHechoVictimizante;
use App\Models\HistorialQuejaViolacion;
use App\Models\HistorialViolenciaMujer;
use App\Models\InformacionComplementaria;
use App\Models\InvMinisterial;
use App\Models\Localidad;
use App\Models\MasInformacion;
use App\Models\ObservacionPreliminarMp;
use App\Models\ObservacionPreliminarOdh;
use App\Models\ObservacionPreliminarPj;
use App\Models\PadronVictima;
use App\Models\ProcesoJudicial;
use App\Models\QuejaOdh;
use App\Models\registroFud;
use App\Models\RelatoHecho;
use App\Models\RelVictimaIndirecta;
use App\Models\Suscriptor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

use function Laravel\Prompts\select;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function solicitudes()
    {
        return view('admin.solicitudes');
    }

    public function listadoFud()
    {

        $listados = DB::table('_registro_fud as f')
            ->where('f.estatus', 'ACTIVO')
            ->orderBy('consecutivo', 'desc')
            ->join('_datos_victima as v', 'f.id', '=', 'v.id_fud')
            ->select('f.*', 'v.*', 'v.id as id_v', 'f.id as id_fud')
            ->get();

        //Buscar que formularios estan vacios


        return view('admin.listadoFud', compact('listados'));
    }

    public function RegistrarFud()
    {

        $tipo_solicitantes = CatTipoSolicitante::where('estatus', '=', 'activo')
            ->get();

        $dependencias = Dependencia::where('estatus', '=', 'activo')
            ->orderBy('nom_dependencia', 'asc')
            ->get();

        $tipoVictimas = CatTipoVictima::where('estatus', '=', 'activo')
            ->get();

        $gentilicios = DB::table('_c_pais')
            ->where('gentilicio', '!=', '')
            ->select('id', 'gentilicio')
            ->orderby('gentilicio', 'asc')
            ->get();

        $edos_civiles = CatEdoCivil::all();

        $paises = CatPaises::all();

        $ent_federativas = CatEntFederativa::all();

        $municipios = DB::table('_c_municipio')
            ->select('id', 'municipio', 'codigo_postal')
            ->get();

        $localidades = Localidad::all();


        return view('admin.registrarFud', compact('localidades', 'municipios', 'ent_federativas', 'paises', 'tipo_solicitantes', 'dependencias', 'tipoVictimas', 'gentilicios', 'edos_civiles'));
    }

    public function muestraLocalidades(Request $request)
    {
        $mostrar = $request->mostrar;
        if ($request->mostrar == 'localidad') {
            $id_municipio = $request->id_municipio;

            $regs = DB::table('_c_localidad as l')
                ->where('id_municipio', $id_municipio)
                ->orderBy('localidad', 'asc')
                ->select('l.*')
                ->get();
        }

        return view('admin.select_localidades', compact('mostrar', 'regs'));
    }

    public function muestraDelitos(Request $request)
    {
        $mostrar = $request->mostrar;
        if ($request->mostrar == 'delito') {
            $clasificacion = $request->clasificacion;

            $regs = DB::table('_c_delito as d')
                ->where('clasificacion', $clasificacion)
                ->select('d.*')
                ->get();
        }

        return view('admin.select_localidades', compact('mostrar', 'regs'));
    }

    public function guardarFud(Request $request)
    {

        DB::beginTransaction();
        try {
            $anio_actual = date("Y");
            $maxValue = registroFud::where('anio', '=', $anio_actual)
                ->max('consecutivo');

            if ($maxValue == '') {
                $consecutivo = 1;
            } else {
                $consecutivo = $maxValue + 1;
            }

            $cuenta_numeros = strlen($consecutivo);
            if ($cuenta_numeros == 1) {
                $consecutivo2 = '0' . $consecutivo;
            } elseif ($cuenta_numeros == 2) {
                $consecutivo2 = $consecutivo;
            }


            $usuarios = DB::table('users')
                ->where('id', $request->id_u)
                ->select('users.id')
                ->first();
            $id_usuario = $usuarios->id;

            $fud = new registroFud();
            $fud->id_usuario = $id_usuario;
            $fud->consecutivo = $consecutivo2;
            $fud->anio = $anio_actual;
            $fud->lugar = $request->lugar;
            $fud->fecha = $request->fecha;
            $fud->tipo_solicitante = $request->tipoSol;
            $fud->estatus = $request->estatus;
            $fud->save();

            $id_fud = registroFud::latest('id')->first();
            $id_fud = $id_fud->id;

            $pais = CatPaises::where('id', '=', $request->paisV)
                ->select('pais')
                ->first();
            $nomPais = $pais->pais;

            $entFederativas = CatEntFederativa::where('id', '=', $request->entFedV)
                ->select('estado')
                ->first();
            $nom_estado = $entFederativas->estado;

            $municipiosV = CatMunicipio::where('id', '=', $request->municipioV)
                ->select('municipio')
                ->first();
            $nomMunicipioV = $municipiosV->municipio;

            $localidadV = Localidad::where('id', '=', $request->localidadV)
                ->select('localidad')
                ->first();
            $nomLocalidadV = $localidadV->localidad;

            $estadoDom = CatEntFederativa::where('id', '=', $request->entFedDomV)
                ->select('estado')
                ->first();
            $nomEstadoDom = $estadoDom->estado;

            $municipioDom = CatMunicipio::where('id', '=', $request->municipioDomV)
                ->select('municipio')
                ->first();
            $nomMunicipioDom = $municipioDom->municipio;

            $localidadDom = Localidad::where('id', '=', $request->localidadDomV)
                ->select('localidad')
                ->first();
            $nomLocalidadDom = $localidadDom->localidad;

            if ($request->tipoSol == 1 || $request->tipoSol == 4) {

                $dVictima = new DatosVictima();
                $dVictima->id_fud = $id_fud;
                $dVictima->id_usuario = $id_usuario;
                $dVictima->tipo_victima = $request->tipoV;
                $dVictima->nombre = $request->nombre;
                $dVictima->primerap = $request->ape_pat;
                $dVictima->segundoap = $request->ape_mat;
                $dVictima->fecha_nacimiento = $request->fechaNac;
                $dVictima->edad = $request->edad;
                $dVictima->sexo = $request->sexo;
                $dVictima->nacionalidad = $request->nacionalidad;
                $dVictima->curp = $request->curp;
                $dVictima->estado_civil = $request->estado_civil;
                $dVictima->tel_fijo = $request->tel_movil;
                $dVictima->tel_movil = $request->tel_fijo;
                $dVictima->id_pais = $request->paisV;
                $dVictima->pais = $nomPais;
                $dVictima->id_estado = $request->entFedV;
                $dVictima->ent_federativa = $nom_estado;
                $dVictima->id_municipio = $request->municipioV;
                $dVictima->municipio = $nomMunicipioV;
                $dVictima->id_localidad = $request->localidadV;
                $dVictima->poblacion = $nomLocalidadV;
                $dVictima->calle = $request->calleV;
                $dVictima->no_exterior = $request->noExteriorV;
                $dVictima->no_interior = $request->noInteriorV;
                $dVictima->codigo_postal = $request->cpV;
                $dVictima->colonia = $request->coloniaV;
                $dVictima->id_estado_dom = $request->entFedDomV;
                $dVictima->ent_federativa_dom = $nomEstadoDom;
                $dVictima->id_municipio_dom = $request->municipioDomV;
                $dVictima->municipio_dom = $nomMunicipioDom;
                $dVictima->id_localidad_dom = $request->localidadDomV;
                $dVictima->localidad = $nomLocalidadDom;
                $dVictima->email = $request->emailVic;
                $dVictima->save();
            } else {
                $dSolicitante = new DatoSolicitante();

                $id_dependencia = $request->dependencia;
                $dependencia = DB::table('_c_dependencias')
                    ->where('id', '=', $id_dependencia)
                    ->select('nom_dependencia')
                    ->first();
                $nom_dependencia = $dependencia->nom_dependencia;

                $dSolicitante->id_reg_fud = $id_fud;
                $dSolicitante->id_usuario = $id_usuario;
                $dSolicitante->curp = $request->curpSol;
                $dSolicitante->nombre = $request->nombreSol;
                $dSolicitante->primerap = $request->apeSol;
                $dSolicitante->segundoap = $request->apeMatSol;
                $dSolicitante->parentesco = $request->parentesco;
                $dSolicitante->cargo = $request->cargo;
                $dSolicitante->id_dependencia = $request->dependencia;
                $dSolicitante->dependencia = $nom_dependencia;
                $dSolicitante->tel_movil = $request->tel_movil;
                $dSolicitante->tel_fijo = $request->tel_fijo;
                $dSolicitante->email = $request->email;
                $dSolicitante->otros_datos_contacto = $request->otros_datos;
                $dSolicitante->save();

                $dVictima = new DatosVictima();
                $dVictima->id_fud = $id_fud;
                $dVictima->id_usuario = $id_usuario;
                $dVictima->tipo_victima = $request->tipoV;
                $dVictima->nombre = $request->nombre;
                $dVictima->primerap = $request->ape_pat;
                $dVictima->segundoap = $request->ape_mat;
                $dVictima->fecha_nacimiento = $request->fechaNac;
                $dVictima->edad = $request->edad;
                $dVictima->sexo = $request->sexo;
                $dVictima->nacionalidad = $request->nacionalidad;
                $dVictima->curp = $request->curp;
                $dVictima->estado_civil = $request->estado_civil;
                $dVictima->tel_fijo = $request->tel_movil;
                $dVictima->tel_movil = $request->tel_fijo;
                $dVictima->id_pais = $request->paisV;
                $dVictima->pais = $nomPais;
                $dVictima->id_estado = $request->entFedV;
                $dVictima->ent_federativa = $nom_estado;
                $dVictima->id_municipio = $request->municipioV;
                $dVictima->municipio = $nomMunicipioV;
                $dVictima->id_localidad = $request->localidadV;
                $dVictima->poblacion = $nomLocalidadV;
                $dVictima->calle = $request->calleV;
                $dVictima->no_exterior = $request->noExteriorV;
                $dVictima->no_interior = $request->noInteriorV;
                $dVictima->codigo_postal = $request->cpV;
                $dVictima->colonia = $request->coloniaV;
                $dVictima->id_estado_dom = $request->entFedDomV;
                $dVictima->ent_federativa_dom = $nomEstadoDom;
                $dVictima->id_municipio_dom = $request->municipioDomV;
                $dVictima->municipio_dom = $nomMunicipioDom;
                $dVictima->id_localidad_dom = $request->localidadDomV;
                $dVictima->localidad = $nomLocalidadDom;
                $dVictima->email = $request->emailVic;
                $dVictima->save();
            }
            $cero = 0;
            $formulario = new FormulariosFud();
            $formulario->id_fud = $id_fud;
            $formulario->rVictimaIndirecta = $cero;
            $formulario->datosIdentificacion = $cero;
            $formulario->relatoHecho = $cero;
            $formulario->invMinisterial = $cero;
            $formulario->historialDelitoIm = $cero;
            $formulario->observacionPreliminarMp = $cero;
            $formulario->procesoJudicial = $cero;
            $formulario->historialDelitoPj = $cero;
            $formulario->observacionPreliminarPj = $cero;
            $formulario->quejaOdh = $cero;
            $formulario->historialQuejaViolacion = $cero;
            $formulario->observacionPreliminarOdh = $cero;
            $formulario->suscriptor = $cero;
            $formulario->infoComplementaria = $cero;
            $formulario->historialDiscapacidad = $cero;
            $formulario->historialHechoVictimizante = $cero;
            $formulario->historialViolenciaMujer = $cero;
            $formulario->masInformacion = $cero;
            $formulario->save();

            DB::commit();

            //return view('admin.listadoFud');
            return redirect()->route('listadoFud')->with('mensaje', 'Información Modificada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    /* public function datoSolicitanteBoC(){

        return view('admin.datoSolicitanteBoC');        
      }
*/
    public function guardarDatoSolicitanteBoC(Request $request)
    {

        DB::beginTransaction();
        try {
            $usuarios = DB::table('users')
                ->where('id', $request->id_u)
                ->select('users.id')
                ->first();
            $id_usuario = $usuarios->id;

            $fud = new registroFud();
            $fud->id_usuario = $id_usuario;
            $fud->lugar = $request->lugar;
            $fud->fecha = $request->fecha;
            $fud->tipo_solicitante = $request->tipoSol;
            $fud->estatus = $request->estatus;
            $fud->save();
            DB::commit();

            if ($request->tipoSol == 1 || $request->tipoSol == 4) {
                return redirect()->route('admin.datosVictima');
            } else {
                // return redirect()->route('admin.datoSolicitanteBoC'); 
                return view('admin.datoSolicitanteBoC');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function masDatosFud(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        $estatusfud = DB::table('_registro_fud as rf')
            ->where('id', '=', $id_fud)
            ->select('rf.estatus','rf.consecutivo','rf.anio')
            ->first();

        $relaciones = DB::table('_r_victima_indirecta as vi')
            ->where('dv.id', $id_v)
            ->join('_datos_victima as dv', 'vi.id_victima_indirecta', '=', 'dv.id')
            ->select('vi.nombre', 'dv.nombre as nvi', 'dv.primerap', 'dv.segundoap', 'vi.tipo_relacion')
            ->get();

        $victima = DB::table('_datos_victima as dv')
            ->where('dv.id', $id_v)
            ->select('dv.nombre', 'dv.primerap', 'dv.segundoap')
            ->first();

        $numRelaciones = DB::table('_r_victima_indirecta as vi')
            ->where('dv.id', $id_v)
            ->join('_datos_victima as dv', 'vi.id_victima_indirecta', '=', 'dv.id')
            ->select('vi.nombre', 'dv.nombre as nvi', 'dv.primerap', 'dv.segundoap', 'vi.tipo_relacion')
            ->count();

        $datosIdes = DB::table('_datos_identificacion as d')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        $numIdes = DB::table('_datos_identificacion as d')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->count();

        $hechos = DB::table('_relato_hecho as rh')
            ->where('estatus', 'ACTIVO')
            ->where('id_reg_fud', $id_fud)
            ->select('rh.*')
            ->get();

        $numHechos = DB::table('_relato_hecho as rh')
            ->where('estatus', 'ACTIVO')
            ->where('id_reg_fud', $id_fud)
            ->select('rh.*')
            ->count();

        $inv_mins = DB::table('_inv_ministerial as im')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('im.*')
            ->get();

        $numIm = DB::table('_inv_ministerial as im')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('im.*')
            ->count();

        $delitosIm = DB::table('_historial_delito_im as dim')
            ->where('im.id_reg_fud', $id_fud)
            ->join('_inv_ministerial as im', 'dim.id_im', '=', 'im.id')
            ->join('_c_delito as d', 'dim.id_delito_violacion', '=', 'd.id')
            ->select('d.delito')
            ->get();

        $observacionesMp = DB::table('_observacion_preliminar_mp as op')
            ->where('id_reg_fud', $id_fud)
            ->join('_inv_ministerial as im', 'op.id_im', '=', 'im.id')
            ->select('tipo_daño', 'observacion')
            ->get();

        $procesoJudicial = DB::table('_proceso_judicial as pj')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('pj.*')
            ->get();

        $numPj = DB::table('_proceso_judicial as pj')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('pj.*')
            ->count();

        $observacionesPj = DB::table('_observacion_preliminar_pj as op')
            ->where('id_reg_fud', $id_fud)
            ->join('_proceso_judicial as pj', 'op.id_pj', '=', 'pj.id')
            ->select('tipo_daño', 'observacion')
            ->get();

        $organismosDh = DB::table('_queja_odh as q')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('q.*')
            ->get();

        $numDh = DB::table('_queja_odh as q')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('q.*')
            ->count();

        $suscriptor = DB::table('_suscriptor as suscriptor')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('suscriptor.*')
            ->first();

        $numSuscriptor = DB::table('_suscriptor as suscriptor')
            ->where('id_reg_fud', $id_fud)
            ->where('estatus', 'ACTIVO')
            ->select('suscriptor.*')
            ->count();

        $infoComplementaria = DB::table('_info_complementaria as i')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('i.*')
            ->first();

        $totalIc = DB::table('_info_complementaria as i')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('i.*')
            ->count();

        $masDatos = DB::table('_mas_informacion as mi')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('mi.*')
            ->first();

        return view('admin.masDatosFud', compact('victima','id_fud', 'id_v', 'estatusfud', 'relaciones', 'numRelaciones', 'datosIdes', 'numIdes', 'hechos', 'numHechos', 'inv_mins', 'numIm', 'procesoJudicial', 'numPj', 'organismosDh', 'numDh', 'suscriptor', 'numSuscriptor', 'infoComplementaria', 'totalIc', 'masDatos'));
    }

    public function agregarRelacion(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        $victimas = DB::table('_padron_victima as pv')
            ->where('estatus', 'ACTIVO')
            ->where('tipo_victima', 'Directa')
            ->select('id', 'nombre_victima')
            ->get();

        $relaciones = DB::table('_c_relacion_vd')
            ->where('estatus', 'ACTIVO')
            ->select('id', 'relacion')
            ->get();
        return view('admin.agregarRelacion', compact('id_fud', 'id_v', 'victimas', 'relaciones'));
    }

    public function guardar_relacion_victima(Request $request)
    {

        DB::beginTransaction();

        try {

            $id_victima_directa = $request->victima;
            $id_fud = $request->id_fud;
            $VicDir = DB::table('_padron_victima')
                ->where('id', $id_victima_directa)
                ->select('id_reg_fud', 'nombre_victima')
                ->first();
            $nombre = $VicDir->nombre_victima;
            $id_fudDir = $VicDir->id_reg_fud;
            $id_relacion = $request->relacion;

            $rel = DB::table('_c_relacion_vd')
                ->where('id', $id_relacion)
                ->select('relacion')
                ->first();
            $relacion = $rel->relacion;
            $uno = 1;


            $relacionVictima = new RelVictimaIndirecta();
            $relacionVictima->id_victima_directa = $request->victima;
            $relacionVictima->id_fud = $id_fudDir;
            $relacionVictima->nombre = $nombre;
            $relacionVictima->id_fud_indirecta = $request->id_fud;
            $relacionVictima->id_victima_indirecta = $request->id_v;
            $relacionVictima->id_relacion = $id_relacion;
            $relacionVictima->tipo_relacion = $relacion;
            $relacionVictima->estatus = 'ACTIVO';
            $relacionVictima->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['rVictimaIndirecta' => $uno]);

            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function agregarIdentificacion(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        return view('admin.agregarIdentificacion', compact('id_fud', 'id_v'));
    }

    public function guardar_identificacion_victima(Request $request)
    {
        if ($request->valor == 'No') {
            return back()->with('mensaje', '¡No hay datos de alguna identificación que guardar!....');
        } else {

            if ($request->hasFile("escaneo")) {
                $file = $request->file("escaneo");

                $nombre = "pdf_" . time() . "." . $file->guessExtension();

                if ($file->guessExtension() == "pdf") {

                    $tipo = DB::table('_c_tipo_identificacion as ide')
                        ->where('id', $request->ide)
                        ->select('tipo')
                        ->first();
                    $tipo_ide = $tipo->tipo;
                    $id_pvictima = $request->id_v;
                    $uno = 1;
                    $id_fud = $request->id_fud;

                    $datosIde = new DatosIdentificacion();
                    $datosIde->id_victima = $id_pvictima;
                    $datosIde->id_ide = $request->ide;
                    $datosIde->tipo_ide = $tipo_ide;
                    $datosIde->otro = $request->otroDoc;
                    $datosIde->doc_probatorio = $request->doc_probatorio;
                    $datosIde->ruta_ide = 'pendiente';
                    $datosIde->ruta_ide2 = 'pendiente';
                    $datosIde->estatus = 'ACTIVO';
                    $datosIde->save();

                    FormulariosFud::where('id_fud', $id_fud)->update(['datosIdentificacion' => $uno]);

                    $id = DatosIdentificacion::latest('id')->first();
                    $idi = $id->id;
                    $ruta = public_path("pdf/pdf_" . $idi . "." . $file->guessExtension());
                    $ruta2 = "pdf/pdf_" . $idi . "." . $file->guessExtension();


                    DatosIdentificacion::where('id', $idi)->update(['ruta_ide' => $ruta]);
                    DatosIdentificacion::where('id', $idi)->update(['ruta_ide2' => $ruta2]);

                    copy($file, $ruta);
                    return back()->with('mensaje', 'Información Guardada Existosamente....');
                } else {
                    return ("Se espera un archivo PDF");
                }
            }
        }
    }

    public function muestraIde(Request $request)
    {
        $id_v = $request->id_v;
        $id_ide = $request->id_ide;

        $ruta_ide = DB::table('_datos_identificacion')
            ->where('id_victima', $id_v)
            ->where('id_ide', $id_ide)
            ->where('estatus', 'ACTIVO')
            ->select('ruta_ide2')
            ->get();

        return view('admin.muestraIde', compact('id_v', 'ruta_ide'));
    }

    public function agregarLugarHechos(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;
        $ent_federativas = CatEntFederativa::all();

        $municipios = DB::table('_c_municipio')
            ->select('id', 'municipio', 'codigo_postal')
            ->get();

        $localidades = Localidad::all();

        return view('admin.agregarLugarHechos', compact('id_fud', 'id_v', 'ent_federativas', 'municipios', 'localidades'));
    }

    public function guardar_lugar_hechos(Request $request)
    {

        DB::beginTransaction();

        try {

            $municipiosV = CatMunicipio::where('id', '=', $request->municipioHechos)
                ->select('municipio')
                ->first();
            $nomMunicipio = $municipiosV->municipio;

            $localidadV = Localidad::where('id', '=', $request->localidadHechos)
                ->select('localidad')
                ->first();
            $nomLocalidad = $localidadV->localidad;
            $id_fud = $request->id_fud;
            $uno = 1;

            $lugarHecho = new RelatoHecho();
            $lugarHecho->id_reg_fud = $request->id_fud;
            $lugarHecho->calle = $request->calle;
            $lugarHecho->no_exterior = $request->numExtVic;
            $lugarHecho->no_interior = $request->numIntVic;
            $lugarHecho->cp = $request->cpHechos;
            $lugarHecho->colonia = $request->coloniaHechos;
            $lugarHecho->id_localidad = $request->localidadHechos;
            $lugarHecho->localidad = $nomLocalidad;
            $lugarHecho->id_municipio = $request->municipioHechos;
            $lugarHecho->municipio = $nomMunicipio;
            $lugarHecho->ent_federativa = $request->entidadFedHechos;
            $lugarHecho->fecha = $request->fechaHechos;
            $lugarHecho->otros_datos = $request->otrosDatos;
            $lugarHecho->hechos = $request->relato;
            $lugarHecho->desc_de_daño_sufrido = $request->descDanio;
            $lugarHecho->estatus = 'ACTIVO';
            $lugarHecho->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['relatoHecho' => $uno]);

            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function agregarAutMp(Request $request)
    {

        $id_fud = $request->id_fud;
        $id_v = $request->id_v;
        $ent_federativas = CatEntFederativa::all();

        $delitosClas = DB::table('_c_delito as d')
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        $delitos = DB::table('_c_delito as d')
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        return view('admin.agregarAutMp', compact('id_fud', 'id_v', 'ent_federativas', 'delitosClas', 'delitos'));
    }

    public function guardar_autoridad_mp(Request $request)
    {
        DB::beginTransaction();
        try {

            $id_fud = $request->id_fud;
            $uno = 1;
            $autoridadMp = new InvMinisterial();

            $autoridadMp->id_reg_fud = $request->id_fud;
            $autoridadMp->denuncia_mp = $request->SiDenuncio;
            $autoridadMp->fecha = $request->fechaMinisterial;
            $autoridadMp->competencia = $request->competencia;
            $autoridadMp->id_ent_federativa = $request->entidadFed;
            $autoridadMp->entidad_federativa =
                //$autoridadMp->delito = $request->delito;
                $autoridadMp->agencia_mp = $request->agenciaMp;
            $autoridadMp->averiguacion_previa = $request->ap;
            $autoridadMp->carpeta_inv = $request->ci;
            $autoridadMp->acta_circ = $request->ac;
            $autoridadMp->edo_inv = $request->edoInv;
            $autoridadMp->estatus = 'ACTIVO';
            $autoridadMp->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['invMinisterial' => $uno]);

            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function agregarDelitoIm(Request $request)
    {
        $id_im = $request->id_im;
        $id_fud = $request->id_fud;

        $delitos = DB::table('_c_delito as d')
            ->groupBy('clasificacion')
            ->select('clasificacion')
            ->get();

        $danios = DB::table('_c_danio as d')
            ->select('d.*')
            ->get();

        return view('admin.agregarDelitoIm', compact('id_im', 'id_fud', 'delitos', 'danios'));
    }

    public function guardar_delito_im(Request $request)
    {

        DB::beginTransaction();

        try {

            $id_im = $request->id_im;
            $id_fud = $request->id_fud;
            $id_danio = $request->danio;

            $daño = DB::table('_c_danio as d')
                ->where('id', $id_danio)
                ->select('d.*')
                ->first();
            $daño = $daño->danio;
            $uno = 1;

            $historial_delitos_mp = new HistorialDelitoIm();
            $historial_delitos_mp->id_delito_violacion = $request->delito;
            $historial_delitos_mp->id_im = $id_im;
            $historial_delitos_mp->tipo = 'delito';
            $historial_delitos_mp->id_danio = $request->danio;
            $historial_delitos_mp->tipo_daño = $daño;
            $historial_delitos_mp->observaciones = $request->observacion;
            $historial_delitos_mp->estatus = 'ACTIVO';
            $historial_delitos_mp->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['historialDelitoIm' => $uno]);

            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function agregarObservacionPreliminarMp(Request $request)
    {
        $id_im = $request->id_im;
        $id_fud = $request->id_fud;

        $danios = DB::table('_c_danio as d')
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        return view('admin.agregarObservacionPreliminarMp', compact('id_im', 'id_fud', 'danios'));
    }

    public function guardar_observacion_preliminar_mp(Request $request)
    {
        DB::beginTransaction();

        try {
            $daño = DB::table('_c_danio')
                ->where('id', $request->danio)
                ->select('danio')
                ->first();
            $daño = $daño->danio;
            $id_fud = $request->id_fud;
            $uno = 1;

            $observacionesMp = new ObservacionPreliminarMp();
            $observacionesMp->id_im = $request->id_im;
            $observacionesMp->id_danio = $request->danio;
            $observacionesMp->tipo_daño = $daño;
            $observacionesMp->observacion = $request->observacion;
            $observacionesMp->estatus = 'ACTIVO';
            $observacionesMp->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['observacionPreliminarMp' => $uno]);

            DB::commit();
            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function agregarAutPj(Request $request)
    {

        $id_fud = $request->id_fud;
        $id_v = $request->id_v;
        $ent_federativas = CatEntFederativa::all();

        $municipios = DB::table('_c_municipio')
            ->select('id', 'municipio', 'codigo_postal')
            ->get();

        $localidades = Localidad::all();

        $tipoJuzgados1 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 1)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados2 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 2)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados3 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 3)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados4 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 4)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados5 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 5)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados6 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 6)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados7 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 7)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados8 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 8)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados9 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 9)
            ->select('tj.tipo')
            ->first();

        $tipoJuzgados10 = DB::table('_c_tipo_juzgado as tj')
            ->where('estatus', 'ACTIVO')
            ->where('id', 10)
            ->select('tj.tipo')
            ->first();

        $juzgado1 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 1)
            ->select('j.*')
            ->get();
        $juzgado2 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 2)
            ->select('j.*')
            ->get();
        $juzgado3 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 3)
            ->select('j.*')
            ->get();
        $juzgado4 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 4)
            ->select('j.*')
            ->get();
        $juzgado5 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 5)
            ->select('j.*')
            ->get();
        $juzgado6 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 6)
            ->select('j.*')
            ->get();
        $juzgado7 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 7)
            ->select('j.*')
            ->get();
        $juzgado8 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 8)
            ->select('j.*')
            ->get();
        $juzgado9 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 9)
            ->select('j.*')
            ->get();
        $juzgado10 = DB::table('_c_juzgados as j')
            ->where('estatus', 'ACTIVO')
            ->where('id_tipo', 10)
            ->select('j.*')
            ->get();

        return view('admin.agregarAutPj', compact('tipoJuzgados10', 'tipoJuzgados9', 'tipoJuzgados8', 'tipoJuzgados7', 'tipoJuzgados6', 'tipoJuzgados5', 'tipoJuzgados4', 'tipoJuzgados3', 'tipoJuzgados2', 'tipoJuzgados1', 'juzgado1', 'juzgado2', 'juzgado3', 'juzgado4', 'juzgado5', 'juzgado6', 'juzgado7', 'juzgado8', 'juzgado9', 'juzgado10', 'id_fud', 'id_v', 'ent_federativas', 'municipios', 'localidades'));
    }

    public function guardar_autoridad_pj(Request $request)
    {

        DB::beginTransaction();

        try {

            $id_fud = $request->id_fud;
            $uno = 1;

            $procesoJudicial = new ProcesoJudicial();
            $procesoJudicial->id_reg_fud = $id_fud;
            $procesoJudicial->fecha_inicio = $request->fechaIniPj;
            $procesoJudicial->competencia = $request->competencia;
            $procesoJudicial->entidad_federativa = $request->entidadFedPj;
            $procesoJudicial->num_juzgado = $request->numJuzgadoPj;
            $procesoJudicial->num_proceso = $request->numProcesoPj;
            $procesoJudicial->edo_pj = $request->edoPj;
            $procesoJudicial->estatus = 'ACTIVO';
            $procesoJudicial->save();

            FormulariosFud::where('id_fud', $id_fud)->update(['procesoJudicial' => $uno]);

            DB::commit();

            return back()->with('message', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado', $e->getMessage();
        }
    }

    public function agregarDelitoPj(Request $request)
    {
        $id_pj = $request->id_pj;

        $delitos = DB::table('_c_delito as d')
            ->groupBy('clasificacion')
            ->select('clasificacion')
            ->get();

        $danios = DB::table('_c_danio as d')
            ->select('d.*')
            ->get();

        return view('admin.agregarDelitoPj', compact('id_pj', 'delitos', 'danios'));
    }

    public function guardar_delito_pj(Request $request)
    {
        DB::beginTransaction();

        try {

            $id_pj = $request->id_pj;
            $id_danio = $request->danio;

            $daño = DB::table('_c_danio as d')
                ->where('id', $id_danio)
                ->select('d.*')
                ->first();
            $daño = $daño->danio;

            $historial_delitos_pj = new HistorialDelitoPj();
            $historial_delitos_pj->id_delito_violacion = $request->delito;
            $historial_delitos_pj->id_pj = $id_pj;
            $historial_delitos_pj->tipo = 'delito';
            $historial_delitos_pj->id_danio = $request->danio;
            $historial_delitos_pj->tipo_daño = $daño;
            $historial_delitos_pj->observaciones = $request->observacion;
            $historial_delitos_pj->estatus = 'ACTIVO';
            $historial_delitos_pj->save();



            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no guardado!!', $e->getMessage();
        }
    }

    public function agregarObservacionPreliminarpJ(Request $request)
    {
        $id_pj = $request->id_pj;

        $danios = DB::table('_c_danio as d')
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        return view('admin.agregarObservacionPreliminarPj', compact('id_pj', 'danios'));
    }

    public function guardar_observacion_preliminar_pj(Request $request)
    {
        DB::beginTransaction();

        try {
            $daño = DB::table('_c_danio')
                ->where('id', $request->danio)
                ->select('danio')
                ->first();
            $daño = $daño->danio;

            $observacionesPj = new ObservacionPreliminarPj();
            $observacionesPj->id_pj = $request->id_pj;
            $observacionesPj->id_danio = $request->danio;
            $observacionesPj->tipo_daño = $daño;
            $observacionesPj->observacion = $request->observacion;
            $observacionesPj->estatus = 'ACTIVO';
            $observacionesPj->save();
            DB::commit();
            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function agregarAutOdh(Request $request)
    {

        $id_fud = $request->id_fud;
        $id_v = $request->id_v;
        $ent_federativas = CatEntFederativa::all();

        $municipios = DB::table('_c_municipio')
            ->select('id', 'municipio', 'codigo_postal')
            ->get();

        $localidades = Localidad::all();

        return view('admin.agregarAutOdH', compact('id_fud', 'id_v', 'ent_federativas', 'municipios', 'localidades'));
    }

    public function guardar_autoridad_odh(Request $request)
    {

        DB::beginTransaction();

        try {

            $odh = new QuejaOdh();

            $id_fud = $request->id_fud;
            $uno = 1;

            $odh->id_reg_fud = $request->id_fud;
            $odh->queja = $request->Pdh;
            $odh->fecha_inicio = $request->fechaPdh;
            $odh->competencia = $request->competencia;
            $odh->organismo = $request->organismoDh;
            $odh->tipo_solucion = $request->tipoSol;
            $odh->folio = $request->folioDh;
            $odh->edo_actual = $request->edoDh;
            $odh->estatus = 'ACTIVO';
            $odh->save();
            FormulariosFud::where('id_fud', $id_fud)->update(['quejaOdh' => $uno]);

            DB::commit();
            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function agregarViolaciones(Request $request)
    {

        $id_odh = $request->id_odh;

        $violaciones = DB::table('_c_violaciones as v')
            ->where('estatus', 'ACTIVO')
            ->select('v.*')
            ->get();

        $dependencias = Dependencia::where('estatus', '=', 'activo')
            ->orderBy('nom_dependencia', 'asc')
            ->get();

        return view('admin.agregarViolaciones', compact('id_odh', 'violaciones', 'dependencias'));
    }

    public function guardar_violaciones(Request $request)
    {
        DB::beginTransaction();

        try {
            $usuarios = DB::table('users')
                ->where('id', $request->id_u)
                ->select('users.id')
                ->first();
            $id_usuario = $usuarios->id;

            $derechov = DB::table('_c_violaciones as v')
                ->where('id', $request->violacion)
                ->select('derecho_violado')
                ->first();
            $derecho_violado = $derechov->derecho_violado;

            $dep = DB::table('_c_dependencias as d')
                ->where('id', $request->dependencia)
                ->select('nom_dependencia')
                ->first();
            $dependencia = $dep->nom_dependencia;


            $violaciones = new HistorialQuejaViolacion();

            $violaciones->id_queja = $request->id_odh;
            $violaciones->id_violacion = $request->violacion;
            $violaciones->derecho_violado = $derecho_violado;
            $violaciones->id_autoridad = $request->dependencia;
            $violaciones->dependencia = $dependencia;
            $violaciones->cargo = $request->cargo;
            $violaciones->nombre = $request->nombre;
            $violaciones->id_usuario = $id_usuario;
            $violaciones->estatus = $request->id_odh;
            $violaciones->save();
            DB::commit();

            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function agregarObservacionPreliminarOdh(Request $request)
    {
        $id_odh = $request->id_odh;

        $danios = DB::table('_c_danio as d')
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        return view('admin.agregarObservacionPreliminarOdh', compact('id_odh', 'danios'));
    }

    public function guardar_observacion_preliminar_odh(Request $request)
    {
        DB::beginTransaction();

        try {
            $daño = DB::table('_c_danio')
                ->where('id', $request->danio)
                ->select('danio')
                ->first();
            $daño = $daño->danio;

            $observacionesOdh = new ObservacionPreliminarOdh();
            $observacionesOdh->id_odh = $request->id_odh;
            $observacionesOdh->id_danio = $request->danio;
            $observacionesOdh->tipo_daño = $daño;
            $observacionesOdh->observacion = $request->observacion;
            $observacionesOdh->estatus = 'ACTIVO';
            $observacionesOdh->save();
            DB::commit();
            return back()->with('mensaje', 'Información Guardada Existosamente....');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }


    public function agregarObservacion(Request $request)
    {

        $id_fud = $request->id_fud;
        $id_v = $request->id_v;
        $ent_federativas = CatEntFederativa::all();

        $municipios = DB::table('_c_municipio')
            ->select('id', 'municipio', 'codigo_postal')
            ->get();

        $localidades = Localidad::all();

        return view('admin.agregarObservacion', compact('id_fud', 'id_v', 'ent_federativas', 'municipios', 'localidades'));
    }

    public function devuelveDelitosIm(Request $request)
    {
        $id_im = $request->id_im;
        $mostrar = "delitosIm";

        $query = "select hdim.id as id_h,delito from _historial_delito_im as hdim
            inner join _c_delito as d on hdim.id_delito_violacion=d.id
            where hdim.id_im=$id_im";
        $regs  = DB::select($query);

        return view('admin.muestraDatos', compact('mostrar', 'regs'));
    }

    public function devuelveDelitosPj(Request $request)
    {
        $id_pj = $request->id_pj;
        $mostrar = "delitosPj";
        /*$regs = DB::table('_historial_delito_pj as hpj')
            ->where('hpj.id_pj',$id_pj)
            ->join('_c_delito as d','hpj.id_delito_violacion','=','d.id')
            ->select('hpj.id as id_h','d.delito')
            ->get();*/
        $query = "select hpj.id as id_h,delito from _historial_delito_pj as hpj
            inner join _c_delito as d on hpj.id_delito_violacion=d.id
            where hpj.id_pj=$id_pj";
        $regs  = DB::select($query);

        $total = DB::table('_historial_delito_pj as hpj')
            ->where('hpj.id_pj', $id_pj)
            ->join('_c_delito as d', 'hpj.id_delito_violacion', '=', 'd.id')
            ->select('hpj.id as id_h', 'd.delito')
            ->count();


        return view('admin.muestraDatos', compact('mostrar', 'regs', 'total'));
    }

    public function devuelveViolacionesOdh(Request $request)
    {
        $id_odh = $request->id_odh;
        $mostrar = "violacionesOdh";

        $query = "SELECT hv.derecho_violado FROM _historial_queja_violacion as hv
            inner join _c_violaciones as v on hv.id_violacion=v.id
            where id_queja=$id_odh";
        $regs  = DB::select($query);

        return view('admin.muestraDatos', compact('mostrar', 'regs'));
    }

    public function devuelveObservacionesIm(Request $request)
    {
        $id_im = $request->id_im;
        $mostrar = "observacionesIm";

        $query = "select tipo_daño,observacion from _observacion_preliminar_mp as op
            inner join _inv_ministerial as im on op.id_im=im.id
            where im.id=$id_im";
        $regs  = DB::select($query);

        return view('admin.muestraDatos', compact('mostrar', 'regs'));
    }

    public function devuelveObservacionesPj(Request $request)
    {
        $id_pj = $request->id_pj;
        $mostrar = "observacionesPj";

        $query = "select tipo_daño,observacion from _observacion_preliminar_pj as op
            inner join _proceso_judicial as pj on op.id_pj=pj.id
            where pj.id=$id_pj";
        $regs  = DB::select($query);

        return view('admin.muestraDatos', compact('mostrar', 'regs'));
    }

    public function devuelveObservacionesOdh(Request $request)
    {
        $id_odh = $request->id_odh;
        $mostrar = "observacionesOdh";

        $query = "select tipo_daño,observacion from _observacion_preliminar_odh as op
            inner join _queja_odh as q on op.id_odh=q.id
            where q.id=$id_odh";
        $regs  = DB::select($query);

        return view('admin.muestraDatos', compact('mostrar', 'regs'));
    }

    public function agregarHoja(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        return view('admin.agregarHoja', compact('id_fud', 'id_v'));
    }

    public function guardar_hoja(Request $request)
    {
        DB::beginTransaction();

        try {

            $id_fud = $request->id_fud;
            $carpeta = public_path("Firmas/Firma" . $id_fud);
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);

                $suscriptor = new Suscriptor();

                $usuarios = DB::table('users')
                    ->where('id', $request->id_u)
                    ->select('users.id')
                    ->first();
                $id_usuario = $usuarios->id;

                $firmaSusc = $request->file("firmaSusc");
                $huellaSusc = $request->file("huellaSusc");
                $manoIzq = $request->file("manoIzq");
                $manoDer = $request->file("manoDer");
                $firmaAut = $request->file("firmaAut");
                $selloAut = $request->file("selloAut");
                $firmaRep = $request->file("firmaRep");
                $firmaRepCeeav = $request->file("firmaRepCeeav");
                $firmaRepCeeav2 = $request->file("firmaRepCeeav2");
                $selloCeeav = $request->file("selloCeeav");

                $suscriptor->id_reg_fud = $request->id_fud;
                $suscriptor->tipo_suscriptor = $request->suscriptor;
                $suscriptor->nombre = $request->ncompletoVic;
                $suscriptor->ruta_firma = 'pendiente';
                $suscriptor->ruta_huella = 'pendiente';
                $suscriptor->email = $request->emailNotificacion;
                $suscriptor->solo_huellas = $request->noFirma;
                $suscriptor->ruta_manoizq = 'pendiente';
                $suscriptor->ruta_manoder = 'pendiente';
                $suscriptor->nombre_servidor = $request->ncompletoAut;
                $suscriptor->cargo = $request->cargoAut;
                $suscriptor->ruta_firma_servidor = 'pendiente';
                $suscriptor->ruta_sello_dependencia = 'pendiente';
                $suscriptor->nombre_rep = $request->ncompletoRep;
                $suscriptor->cargo_rep = $request->cargoRep;
                $suscriptor->ruta_firma_rep = 'pendiente';
                $suscriptor->nombre_per_ceeav = $request->ncompletoCeeav;
                $suscriptor->cargo_per_ceeav = $request->cargoRepCeeav;
                $suscriptor->ruta_firma_per_ceeav = 'pendiente';
                $suscriptor->nombre_per_ceeav2 = $request->ncompletoCeeav2;
                $suscriptor->cargo_per_ceeav2 = $request->cargoRepCeeav2;
                $suscriptor->ruta_firma_per_ceeav2 = 'pendiente';
                $suscriptor->ruta_sello_ceeav = 'pendiente';
                $suscriptor->estatus = 'ACTIVO';
                $suscriptor->id_usuario = $id_usuario;
                $suscriptor->ruta_doc = 'pendiente';
                $suscriptor->save();

                $id = Suscriptor::latest('id')->first();
                $idi = $id->id;

                if (!empty($firmaSusc)) {
                    $ruta1 = public_path("Firmas/Firma" . $id_fud . "/firmaSusc_" . $idi . "." . $firmaSusc->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_firma' => $ruta1]);
                    copy($firmaSusc, $ruta1);
                } else {
                }
                if (!empty($huellaSusc)) {
                    $ruta2 = public_path("Firmas/Firma" . $id_fud . "/huellaSusc_" . $idi . "." . $huellaSusc->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_huella' => $ruta2]);
                    copy($huellaSusc, $ruta2);
                } else {
                }
                if (!empty($manoIzq)) {
                    $ruta3 = public_path("Firmas/Firma" . $id_fud . "/manoIzq_" . $idi . "." . $manoIzq->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_manoizq' => $ruta3]);
                    copy($manoIzq, $ruta3);
                } else {
                }
                if (!empty($manoDer)) {
                    $ruta4 = public_path("Firmas/Firma" . $id_fud . "/manoDer_" . $idi . "." . $manoDer->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_manoder' => $ruta4]);
                    copy($manoDer, $ruta4);
                } else {
                }
                if (!empty($firmaAut)) {
                    $ruta5 = public_path("Firmas/Firma" . $id_fud . "/firmaAut_" . $idi . "." . $firmaAut->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_firma_servidor' => $ruta5]);
                    copy($firmaAut, $ruta5);
                } else {
                }
                if (!empty($selloAut)) {
                    $ruta6 = public_path("Firmas/Firma" . $id_fud . "/selloAut_" . $idi . "." . $selloAut->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_sello_dependencia' => $ruta6]);
                    copy($selloAut, $ruta6);
                } else {
                }
                if (!empty($firmaRep)) {
                    $ruta7 = public_path("Firmas/Firma" . $id_fud . "/firmaRep_" . $idi . "." . $firmaRep->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_firma_rep' => $ruta7]);
                    copy($firmaRep, $ruta7);
                } else {
                }
                if (!empty($firmaRepCeeav)) {
                    $ruta8 = public_path("Firmas/Firma" . $id_fud . "/firmaRepCeeav_" . $idi . "." . $firmaRepCeeav->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_firma_per_ceeav' => $ruta8]);
                    copy($firmaRepCeeav, $ruta8);
                } else {
                }
                if (!empty($firmaRepCeeav2)) {
                    $ruta9 = public_path("Firmas/Firma" . $id_fud . "/firmaRepCeeav2_" . $idi . "." . $firmaRepCeeav2->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_firma_per_ceeav2' => $ruta9]);
                    copy($firmaRepCeeav2, $ruta9);
                } else {
                }
                if (!empty($selloCeeav)) {
                    $ruta10 = public_path("Firmas/Firma" . $id_fud . "/selloCeeav_" . $idi . "." . $selloCeeav->guessExtension());
                    Suscriptor::where('id', $idi)->update(['ruta_sello_ceeav' => $ruta10]);
                    copy($selloCeeav, $ruta10);
                } else {
                }
                $uno = 1;
                FormulariosFud::where('id_fud', $id_fud)->update(['suscriptor' => $uno]);

                DB::commit();


                return back()->with('mensaje', 'Información Guardada Existosamente....');
            } else {
                DB::commit();
                return back()->with('mensaje', 'La información ya existe,  solo puede editarla....');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function agregarInfoComp(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        $etnias = DB::table('_c_grupo_etnico as e')
            ->select('e.*')
            ->get();

        return view('admin.agregarInfoComp', compact('id_fud', 'id_v', 'etnias'));
    }

    public function guardar_infoComp(Request $request)
    {

        DB::beginTransaction();

        try {
            $id_fud = $request->id_fud;

            $infoComplementaria = new InformacionComplementaria();

            $infoComplementaria->id_victima = $request->id_victima;
            $infoComplementaria->id_reg_fud = $request->id_fud;
            $infoComplementaria->nina_adolescente = $request->nina;
            $infoComplementaria->tutor = $request->tutor;
            $infoComplementaria->contacto_tutor = $request->contactoTutor;
            $infoComplementaria->tel_tutor = $request->telTutor;
            $infoComplementaria->adulto_mayor = $request->adulto;
            $infoComplementaria->situacion_calle = $request->calle;
            $infoComplementaria->discapacidad = $request->discapacidad;
            $infoComplementaria->indigena = $request->indigena;
            $infoComplementaria->poblacion_ind = $request->pobIndigena;
            $infoComplementaria->migrante = $request->migrante;
            $infoComplementaria->pais_origen = $request->paisOrigen;
            $infoComplementaria->pais_destino = $request->paisDestino;
            $infoComplementaria->idioma = $request->idioma;
            $infoComplementaria->traductor = $request->traductor;
            $infoComplementaria->refugiado = $request->refugiado;
            $infoComplementaria->asilado_politico = $request->asilado;
            $infoComplementaria->tramite_condicion = $request->refugiado1;
            $infoComplementaria->defensor_dh = $request->defensor;
            $infoComplementaria->tiene_institucion = $request->institucion;
            $infoComplementaria->tipo_institucion = $request->inst;
            $infoComplementaria->periodista = $request->periodista;
            $infoComplementaria->medio_informativo = $request->traductor;
            $infoComplementaria->nombre_medio = $request->nombreMedio;
            $infoComplementaria->desplazado = $request->desplazado;
            $infoComplementaria->entidad_salida = $request->entidadSalida;
            $infoComplementaria->entidad_receptora = $request->entidadReceptora;
            $infoComplementaria->fecha_doc = $request->fechaDoc;
            $infoComplementaria->presentadoPor = $request->presentadoPor;
            $infoComplementaria->estatus = 'ACTIVO';
            $infoComplementaria->save();
            /*estos datos van para la tabla historial_discapacidad */
            $id = InformacionComplementaria::latest('id')->first();
            $idi = $id->id;

            if ($request->discapacidad == "Si") {

                $disFisica = $request->disFisica;
                $dependencia1 = $request->dependencia1;
                $disMental = $request->disMental;
                $dependencia2 = $request->dependencia2;
                $disIntelectual = $request->disIntelectual;
                $dependencia3 = $request->dependencia3;
                $disVisual = $request->disVisual;
                $dependencia4 = $request->dependencia4;
                $disAuditiva = $request->disAuditiva;
                $dependencia5 = $request->dependencia5;


                if (!empty($disFisica) && !empty($dependencia1)) {
                    $histDiscapacidad = new HistorialDiscapacidad();
                    $histDiscapacidad->id_info_complementaria = $idi;
                    $histDiscapacidad->id_victima = $request->id_victima;
                    $histDiscapacidad->tipo = $disFisica;
                    $histDiscapacidad->grado = $dependencia1;
                    $histDiscapacidad->estatus = "ACTIVO";
                    $histDiscapacidad->save();
                }
                if (!empty($disMental) && !empty($dependencia2)) {

                    $histDiscapacidad = new HistorialDiscapacidad();
                    $histDiscapacidad->id_info_complementaria = $idi;
                    $histDiscapacidad->id_victima = $request->id_victima;
                    $histDiscapacidad->tipo = $disMental;
                    $histDiscapacidad->grado = $dependencia2;
                    $histDiscapacidad->estatus = "ACTIVO";
                    $histDiscapacidad->save();
                }
                if (!empty($disIntelectual) && !empty($dependencia3)) {
                    $histDiscapacidad = new HistorialDiscapacidad();
                    $histDiscapacidad->id_info_complementaria = $idi;
                    $histDiscapacidad->id_victima = $request->id_victima;
                    $histDiscapacidad->tipo = $disIntelectual;
                    $histDiscapacidad->grado = $dependencia3;
                    $histDiscapacidad->estatus = "ACTIVO";
                    $histDiscapacidad->save();
                }
                if (!empty($disVisual) && !empty($dependencia4)) {
                    $histDiscapacidad = new HistorialDiscapacidad();
                    $histDiscapacidad->id_info_complementaria = $idi;
                    $histDiscapacidad->id_victima = $request->id_victima;
                    $histDiscapacidad->tipo = $disVisual;
                    $histDiscapacidad->grado = $dependencia4;
                    $histDiscapacidad->estatus = "ACTIVO";
                    $histDiscapacidad->save();
                }
                if (!empty($disAuditiva) && !empty($dependencia5)) {
                    $histDiscapacidad = new HistorialDiscapacidad();
                    $histDiscapacidad->id_info_complementaria = $idi;
                    $histDiscapacidad->id_victima = $request->id_victima;
                    $histDiscapacidad->tipo = $disAuditiva;
                    $histDiscapacidad->grado = $dependencia5;
                    $histDiscapacidad->estatus = "ACTIVO";
                    $histDiscapacidad->save();
                    $uno = 1;
                    FormulariosFud::where('id_fud', $id_fud)->update(['historialDiscapacidad' => $uno]);
                }
            }

            /*estos datos van para la tabla historial_hecho_victimizante */
            $hechos = $request['hecho'];
            foreach ($hechos as $hecho) {
                $hechoVic = new HistorialHechoVictimizante();
                $hechoVic->id_info_complementaria = $idi;
                $hechoVic->id_victima = $request->id_victima;
                $hechoVic->tipo = $hecho;
                $hechoVic->estatus = "ACTIVO";
                $hechoVic->save();
                $uno = 1;
                FormulariosFud::where('id_fud', $id_fud)->update(['historialHechoVictimizante' => $uno]);
            }

            /*estos datos van para la tabla historial_violencia_mujer */
            $violencia = $request['violencia'];
            foreach ($violencia as $violencia) {
                $histo_violencia = new HistorialViolenciaMujer();
                $histo_violencia->id_info_complementaria = $idi;
                $histo_violencia->id_victima = $request->id_victima;
                $histo_violencia->tipo = $violencia;
                $histo_violencia->estatus = "ACTIVO";
                $histo_violencia->save();
                $uno = 1;
                FormulariosFud::where('id_fud', $id_fud)->update(['historialViolenciaMujer' => $uno]);
            }

            $uno = 1;
            FormulariosFud::where('id_fud', $id_fud)->update(['infoComplementaria' => $uno]);

            DB::commit();
            return back()->with('mensaje', '¡Registro guardado Exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function resumenInfoComp(Request $request)
    {
        $id_v = $request->id_v;

        $datos = DB::table('_info_complementaria as ic')
            ->where('id_victima', $id_v)
            ->select('ic.*')
            ->first();

        $hechos = DB::table('_historial_hecho_victimizante as h')
            ->where('id_victima', $id_v)
            ->where('tipo', '!=', '')
            ->where('estatus', 'ACTIVO')
            ->select('h.*')
            ->get();

        $discapacidades = DB::table('_historial_discapacidad as d')
            ->where('id_victima', $id_v)
            ->where('estatus', 'ACTIVO')
            ->select('d.*')
            ->get();

        $violenciaMujeres = DB::table('_historial_violencia_mujer as v')
            ->where('id_victima', $id_v)
            ->where('tipo', '!=', '')
            ->where('estatus', 'ACTIVO')
            ->select('v.*')
            ->get();

        return view('admin.resumenInfoComp', compact('id_v', 'datos', 'hechos', 'discapacidades', 'violenciaMujeres'));
    }

    public function agregarMasInfo(Request $request)
    {
        $id_fud = $request->id_fud;
        $id_v = $request->id_v;

        return view('admin.agregarMasInfo', compact('id_fud', 'id_v'));
    }

    public function guardarMasInformacion(Request $request)
    {

        DB::beginTransaction();
        try {

            $id_fud = $request->id_fud;
            $id_v = $request->id_victima;

            $masInfo = new MasInformacion();

            $masInfo->id_victima = $id_v;
            $masInfo->id_reg_fud = $id_fud;
            $masInfo->mas_info = $request->observaciones;
            $masInfo->estatus = 'ACTIVO';
            $masInfo->save();
            $uno = 1;
            FormulariosFud::where('id_fud', $id_fud)->update(['masInformacion' => $uno]);


            DB::commit();

            return back()->with('mensaje', '¡Registro guardado Exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function inscripcionPadron(Request $request)
    {
        $id_fud = $request->id_fud;

        $query1 = "SELECT count(*)as total FROM _padron_victima as p
                        where id_reg_fud=$id_fud and estatus='ACTIVO'";
        $cuenta = DB::select($query1);
        $cuenta_victimas = $cuenta[0]->total;

        $validacionForms = DB::table('_formulariosfud as f')
            ->where('id_fud', $id_fud)
            ->select('f.*')
            ->first();
        $rVictimaIndirecta = $validacionForms->rVictimaIndirecta;
        $datosIdentificacion = $validacionForms->datosIdentificacion;
        $relatoHecho = $validacionForms->relatoHecho;
        $invMinisterial = $validacionForms->invMinisterial;
        $procesoJudicial = $validacionForms->procesoJudicial;
        $quejaOdh = $validacionForms->quejaOdh;
        $suscriptor = $validacionForms->suscriptor;
        $infoComplementaria = $validacionForms->infoComplementaria;
        $historialDiscapacidad = $validacionForms->historialDiscapacidad;
        $historialHechoVictimizante = $validacionForms->historialHechoVictimizante;
        $historialViolenciaMujer = $validacionForms->historialViolenciaMujer;
        $masInformacion = $validacionForms->masInformacion;


        $mensajes = [
            "rVictimaIndirecta" => "Agrega la relación con la víctima directa",
            "datosIdentificacion" => "Agrega los datos de identificación",
            "relatoHecho" => "Agrega el lugar y fecha de los hechos",
            "invMinisterial" => "Agrega las autoridades que han conocido de los hechos",
            "procesoJudicial" => "Agrega las autoridades que han conocido de los hechos",
            "quejaOdh" => "Agrega las autoridades que han conocido de los hechos",
            "suscriptor" => "Agrega la hoja de firmas",
            "infoComplementaria" => "Agrega la información complementaria",
            "masInformacion" => "Agrega más información"
        ];

        $mensaje = '<b>'."Te hace falta la siguiente información:".'</b>';
        foreach ($mensajes as $variable => $texto) {
            if ($$variable == 0) {
                $mensaje .= "<br> " . $texto;
            }
        }

        // Eliminar la coma inicial y espacios en blanco
        $mensaje = ltrim($mensaje, "<br> ");


        $query = "SELECT sum(rVictimaIndirecta+datosIdentificacion+relatoHecho+invMinisterial+procesoJudicial+quejaOdh+suscriptor+infoComplementaria+historialDiscapacidad+historialHechoVictimizante+historialViolenciaMujer+masInformacion)as total FROM _formulariosfud as f
        where id_fud=$id_fud";

        $total = DB::select($query);
        $total2 = $total[0]->total;

        $tipo_victima = DB::table('_datos_victima as v')
            ->where('id_fud', $id_fud)
            ->select('tipo_victima')
            ->first();
        $tipoV = $tipo_victima->tipo_victima;

        if ($cuenta_victimas < 1 && $tipoV != 1 && $total2 == 12) {

            return view('admin.inscripcionPadron', compact('id_fud'));
        } else if ($cuenta_victimas < 1 && $tipoV == 1 && $total2 == 12) {

            return view('admin.inscripcionPadron', compact('id_fud'));
        } else if ($tipoV != 1 && $total2 < 12) {
            if ($cuenta_victimas == 0) {
                return $mensaje;
            } else {
                return $mensaje = "Ya se encuentra registrado en el Padrón";
            }
        } else if ($tipoV == 1 && $total2 < 12) {
            if ($cuenta_victimas == 0) {
                return $mensaje;
            } else {
                return $mensaje = "Ya se encuentra registrado en el Padrón";
            }
        }
    }

    public function guardar_inscripcionPadron(Request $request)
    {
        DB::beginTransaction();

        try {
            $id_fud = $request->id_fud;
            $query = "SELECT count(*)as total FROM _padron_victima as p
                        where id_reg_fud=$id_fud and estatus='ACTIVO'";
            $cuenta = DB::select($query);
            $cuenta_victimas = $cuenta[0]->total;
            if ($cuenta_victimas > 0) {
                DB::commit();
                return back()->with('mensaje', '¡Este registro ya se encuentra en el padrón!');
            } else {


                $datos = DB::table('_registro_fud as f')
                    ->where('f.estatus', '=', 'ACTIVO')
                    ->where('f.id', '=', $id_fud)
                    ->join('_datos_victima as v', 'f.id', '=', 'v.id_fud')
                    ->select('f.*', 'v.*', 'v.id as id_v', 'f.id as id_fud')
                    ->first();

                $curp = $datos->curp;
                $rfc = "Pendiente";
                $nombre = $datos->nombre;
                $primer_ap = $datos->primerap;
                $segundo_ap = $datos->segundoap;
                $nombre_victima = $nombre;
                $primerap = $primer_ap;
                $segundoap = $segundo_ap;
                $tipo_daño = $request->tipo_danio;
                $tipo_victima = $request->tipo_victima;

                $usuarios = DB::table('users')
                    ->where('id', $request->id_u)
                    ->select('users.id')
                    ->first();
                $id_usuario = $usuarios->id;

                $anio_actual = date("Y");
                $maxValue = PadronVictima::where('anio', '=', $anio_actual)
                    ->max('folio');

                if ($maxValue == '') {
                    $consecutivo = 1;
                } else {
                    $consecutivo = $maxValue + 1;
                }


                $padron = new PadronVictima();

                $iniciales = 'REV/OAX/';
                $cuenta_numeros = strlen($consecutivo);
                if ($cuenta_numeros == 1) {
                    $consecutivo2 = '0' . $consecutivo;
                } elseif ($cuenta_numeros == 2) {
                    $consecutivo2 = $consecutivo;
                }
                $nomenclatura = $iniciales . $consecutivo2 . '/' . $anio_actual;

                $padron->id_reg_fud = $request->id_fud;
                $padron->id_usuario = $id_usuario;
                $padron->fecha = $request->fecha;
                $padron->anio = $anio_actual;
                $padron->folio = $consecutivo;
                $padron->curp = $curp;
                $padron->rfc = $rfc;
                $padron->nombre_victima = $nombre_victima;
                $padron->primer_apellido = $primerap;
                $padron->segundo_apellido = $segundoap;
                $padron->tipo_daño = $tipo_daño;
                $padron->tipo_victima = $tipo_victima;
                $padron->estado = "ACTIVO";
                $padron->estatus = "ACTIVO";
                $padron->nomenclatura = $nomenclatura;
                $padron->save();

                DB::commit();

                return redirect()->route('listadoPadron')->with('mensaje', 'Información Modificada Existosamente....');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Registro no Guardado!!', $e->getMessage();
        }
    }

    public function listadoPadron(Request $request)
    {
        $listados = DB::table('_padron_victima as p')
            ->where('p.estatus', '=', 'ACTIVO')
            ->select('p.*')
            ->get();

        return view('admin.listadoPadron', compact('listados'));
    }
}
