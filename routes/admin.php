<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\FudController;
use App\Http\Controllers\Admin\CatalogosController;
use App\Http\Controllers\Admin\PDFController;

////////////////Pagina principal de bienvenida
Route::get('', [HomeController::class,'index'])->name('index');

/////////////////////////Modulo de registro de solicitudes normales ///////////////////////////////////
//Ruta para mostrar el listado de solicitudes
Route::get('/solicitudes', [HomeController::class,'solicitudes'])->name('solicitudes');

//////////////////////////////////Padron de victimas//////////////////////////////////////////////////
//Ruta para mostrar el listado de Fud's
Route::get('/listadoFud', [HomeController::class,'listadoFud'])->name('listadoFud');
//Ruta que muestra formulario para crear un registro fud
Route::get('/registrarFud', [HomeController::class,'registrarFud'])->name('registrarFud');
Route::post('/muestraLocalidades', [HomeController::class, 'muestraLocalidades'])->name('muestraLocalidades');
Route::post('/muestraDelitos', [HomeController::class, 'muestraDelitos'])->name('muestraDelitos');

//Ruta para guardar registro fud
Route::post('/guardarFud', [HomeController::class, 'guardarFud'])->name('guardarFud');

Route::get('/masDatosFud', [HomeController::class, 'masDatosFud'])->name('masDatosFud');
Route::get('/agregarRelacion', [HomeController::class, 'agregarRelacion'])->name('agregarRelacion');
Route::post('/guardar_relacion_victima', [HomeController::class, 'guardar_relacion_victima'])->name('guardar_relacion_victima');

Route::get('/agregarIdentificacion', [HomeController::class, 'agregarIdentificacion'])->name('agregarIdentificacion');
Route::post('guardar_identificacion_victima', [HomeController::class, 'guardar_identificacion_victima'])->name('guardar_identificacion_victima');
Route::get('/muestraIde', [HomeController::class, 'muestraIde'])->name('muestraIde');

Route::get('/agregarLugarHechos', [HomeController::class, 'agregarLugarHechos'])->name('agregarLugarHechos');
Route::post('guardar_lugar_hechos', [HomeController::class, 'guardar_lugar_hechos'])->name('guardar_lugar_hechos');

Route::get('agregarAutMp', [HomeController::class, 'agregarAutMp'])->name('agregarAutMp');
Route::post('guardar_autoridad_mp', [HomeController::class, 'guardar_autoridad_mp'])->name('guardar_autoridad_mp');
Route::get('/agregarDelitoIm',[HomeController::class, 'agregarDelitoIm'])->name('agregarDelitoIm');
Route::post('/guardar_delito_im', [HomeController::class, 'guardar_delito_im'])->name('guardar_delito_im');
Route::get('/agregarObservacionPreliminarMp',[HomeController::class, 'agregarObservacionPreliminarMp'])->name('agregarObservacionPreliminarMp');
Route::post('/guardar_observacion_preliminar_mp', [HomeController::class, 'guardar_observacion_preliminar_mp'])->name('guardar_observacion_preliminar_mp');


Route::get('agregarAutPj', [HomeController::class, 'agregarAutPj'])->name('agregarAutPj');
Route::post('guardar_autoridad_pj', [HomeController::class, 'guardar_autoridad_pj'])->name('guardar_autoridad_pj');
Route::get('/agregarDelitoPj',[HomeController::class, 'agregarDelitoPj'])->name('agregarDelitoPj');
Route::post('/guardar_delito_pj', [HomeController::class, 'guardar_delito_pj'])->name('guardar_delito_pj');
Route::get('/agregarObservacionPreliminarPj',[HomeController::class, 'agregarObservacionPreliminarPj'])->name('agregarObservacionPreliminarPj');
Route::post('/guardar_observacion_preliminar_pj', [HomeController::class, 'guardar_observacion_preliminar_pj'])->name('guardar_observacion_preliminar_pj');
Route::post('/devuelveDelitosIm',[HomeController::class, 'devuelveDelitosIm'])->name('devuelveDelitosIm');
Route::post('/devuelveObservacionesIm',[HomeController::class, 'devuelveObservacionesIm'])->name('devuelveObservacionesIm');
Route::post('/devuelveDelitosPj',[HomeController::class, 'devuelveDelitosPj'])->name('devuelveDelitosPj');
Route::post('/devuelveObservacionesPj',[HomeController::class, 'devuelveObservacionesPj'])->name('devuelveObservacionesPj');
Route::post('/devuelveViolacionesOdh',[HomeController::class, 'devuelveViolacionesOdh'])->name('devuelveViolacionesOdh');
Route::post('/devuelveObservacionesOdh',[HomeController::class, 'devuelveObservacionesOdh'])->name('devuelveObservacionesOdh');

Route::get('agregarAutOdh', [HomeController::class, 'agregarAutOdh'])->name('agregarAutOdh');
Route::post('guardar_autoridad_odh', [HomeController::class, 'guardar_autoridad_odh'])->name('guardar_autoridad_odh');
Route::get('agregarViolaciones', [HomeController::class, 'agregarViolaciones'])->name('agregarViolaciones');
Route::post('guardar_violaciones', [HomeController::class, 'guardar_violaciones'])->name('guardar_violaciones');
Route::get('/agregarObservacionPreliminarOdh',[HomeController::class, 'agregarObservacionPreliminarOdh'])->name('agregarObservacionPreliminarOdh');
Route::post('/guardar_observacion_preliminar_odh', [HomeController::class, 'guardar_observacion_preliminar_odh'])->name('guardar_observacion_preliminar_odh');

Route::get('agregarHoja', [HomeController::class, 'agregarHoja'])->name('agregarHoja');
Route::post('guardar_hoja', [HomeController::class, 'guardar_hoja'])->name('guardar_hoja');

Route::get('agregarInfoComp', [HomeController::class, 'agregarInfoComp'])->name('agregarInfoComp');
Route::post('guardar_infoComp', [HomeController::class, 'guardar_infoComp'])->name('guardar_infoComp');
Route::get('resumenInfoComp', [HomeController::class, 'resumenInfoComp'])->name('resumenInfoComp');

Route::get('agregarMasInfo', [HomeController::class, 'agregarMasInfo'])->name('agregarMasInfo');
Route::post('guardarMasInformacion', [HomeController::class, 'guardarMasInformacion'])->name('guardarMasInformacion');

Route::get('inscripcionPadron', [HomeController::class, 'inscripcionPadron'])->name('inscripcionPadron');
Route::post('guardar_inscripcionPadron', [HomeController::class, 'guardar_inscripcionPadron'])->name('guardar_inscripcionPadron');

Route::get('/listadoPadron', [HomeController::class,'listadoPadron'])->name('listadoPadron');
/*Route::get('/constancia/{id_reg_fud}/',[HomeController::class,'constancia'])->name('constancia');*/
Route::get('/constancia/{id_reg_fud}/',[PDFController::class,'constancia'])->name('constancia');

Route::get('agregarObservacion', [HomeController::class, 'agregarObservacion'])->name('agregarObservacion');
Route::post('guardar_observacion', [HomeController::class, 'guardar_observacion'])->name('guardar_observacion');

Route::get('/datoSolicitanteBoC', [HomeController::class, 'datoSolicitanteBoC'])->name('datoSolicitanteBoC');
Route::get('/guardardatoSolicitanteBoC', [HomeController::class, 'guardardatoSolicitanteBoC'])->name('guardardatoSolicitanteBoC');

//Ruta para mostrar un registro

//Ruta para mostrar formulario de editar registro fud

//Ruta para actualizar un registro fud

//Ruta para eliminar un registro fud

/////////////////////////////////////////////////RUTAS DE CATALOGOS///////////////////////////////////////////////////////
Route::post('/localidades', [CatalogosController::class, 'localidades'])->name('localidades');
