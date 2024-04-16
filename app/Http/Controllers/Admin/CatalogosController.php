<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogosController extends Controller
{
    public function localidades(Request $request){
        $mostrar = $request->mostrar;
            $idmunicipio = $request->id_municipio;
            $regs = DB::table('_c_localidad')
                ->where('id_municipio', $idmunicipio)
                ->select('_c_localidad.*')
                ->get();
        

        return view('admin.localidades', compact('mostrar', 'regs'));

    }
}
