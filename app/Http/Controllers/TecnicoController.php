<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
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
         $tecnicos = Tecnico::where('estado', '=', 1)->get();

         return view('tecnico.index', [
             'tecnicos' => $tecnicos
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
      return view('tecnico.create');
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
          'dpi' => 'required',
          'fecha_nacimiento' => 'required',
          'telefono' => 'required',

      ]);

      $tecnico=Tecnico::create($request->all());

      return redirect('tecnico')->with('Listo', 'tecnico creado correctamente');
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
        $tecnico = Tecnico::findOrFail($id);

        return view('tecnico.edit', [
            'tecnico' => $tecnico
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
            'dpi' => 'required',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'correo' => 'nullable'
        ]);

        $tecnico= Tecnico::whereId($id)->update($validatedData);

        return redirect('tecnico')->with('Listo', 'Tecnico editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tecnico = Tecnico::findOrFail($id);
        
        $tecnico->estado = 0;
        $tecnico->update();

        return redirect('tecnico')->with('Listo', 'Tecnico eliminado correctamente');
    }
}
