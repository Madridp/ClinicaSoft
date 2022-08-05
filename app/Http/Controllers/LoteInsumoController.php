<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\LoteInsumo;
use App\Models\TipoInsumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoteInsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); // el usuario debe estar autenticado
    }
    public function index()
    {
        if ( Auth::user()->id_rol == 3 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $lote_insumos = LoteInsumo::where('estado', '=', 1)->get();

        return view('lote_insumo.index', [
            'lote_insumos' => $lote_insumos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Auth::user()->id_rol == 3 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $tipo_insumos = TipoInsumo::all();
        return view('insumo.create', [
            'tipo_insumos' => $tipo_insumos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_tipo_insumo' => 'required',
            'codigo' => 'required',
            'nombre' => 'required',
            'es_reactivo' => 'required',
          ]);
    
          $insumo=Insumo::create($request->all());
    
          return redirect('insumo')->with('Listo', 'insumo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( Auth::user()->id_rol == 3 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $insumo = Insumo::findOrFail($id);
        $tipo_insumos = TipoInsumo::where('estado', '=', 1)->get();

        return view('insumo.edit', [
            'insumo' => $insumo,
            'tipo_insumos' => $tipo_insumos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_tipo_insumo' => 'required',
            'codigo' => 'required',
            'nombre' => 'required',
            'es_reactivo' => 'required',
        ]);

        $insumo= Insumo::whereId($id)->update($validatedData);

        return redirect('insumo')->with('Listo', 'insumo editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insumo = insumo::findOrFail($id);
        
        $insumo->estado = 0;
        $insumo->update();

        return redirect('insumo')->with('Listo', 'insumo eliminado correctamente');
    }
}
