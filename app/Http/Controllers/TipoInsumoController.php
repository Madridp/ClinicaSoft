<?php

namespace App\Http\Controllers;

use App\Models\TipoInsumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoInsumoController extends Controller
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
        //dd('aca LLEGA JEJE');
        $tipoInsumos = TipoInsumo::where('estado', '=', 1)->get();

        return view('tipoInsumo.index', [
            'tipoInsumos' => $tipoInsumos
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
      return view('tipoInsumo.create');
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
        'nombre' => 'required',
        
      ]);

      $tipoInsumo=TipoInsumo::create($request->all());

      return redirect('tipoInsumo')->with('Listo', 'tipo de insumo creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
        $tipoInsumo = TipoInsumo::findOrFail($id);

        return view('tipoInsumo.edit', [
            'tipoInsumo' => $tipoInsumo
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
            'nombre' => 'required',
            
        ]);

        $tipoInsumo= TipoInsumo::whereId($id)->update($validatedData);

        return redirect('tipoInsumo')->with('Listo', 'tipo de insumo editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoInsumo = TipoInsumo::findOrFail($id);
        
        $tipoInsumo->estado = 0;
        $tipoInsumo->update();

        return redirect('tipoInsumo')->with('Listo', 'tipo de insumo eliminado correctamente');
    }
}
