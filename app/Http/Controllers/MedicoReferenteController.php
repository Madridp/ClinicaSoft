<?php

namespace App\Http\Controllers;

use App\Models\MedicoReferente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoReferenteController extends Controller
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
        $medicos = MedicoReferente::where('estado', '=', 1)->get();

        return view('medicoReferente.index', [
            'medicos' => $medicos
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
        return view('medicoReferente.create');
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
    
          $medicos=MedicoReferente::create($request->all());
    
          return redirect('medicoReferente')->with('Listo', 'medico creado correctamente');
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
        $medico = MedicoReferente::findOrFail($id);

        return view('medicoReferente.edit', [
            'medico' => $medico
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

        $medicos= MedicoReferente::whereId($id)->update($validatedData);

        return redirect('medicoReferente')->with('Listo', 'medico editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = MedicoReferente::findOrFail($id);
        
        $medico->estado = 0;
        $medico->update();

        return redirect('medicoReferente')->with('Listo', 'medico eliminado correctamente');
    }
}
