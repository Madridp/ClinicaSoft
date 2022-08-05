<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
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
        $pacientes = Paciente::where('estado', '=', 1)->get();

        return view('paciente.index', [
            'pacientes' => $pacientes
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
      return view('paciente.create');
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
        'apellido' => 'required',
        'genero' => 'required',
        'telefono' => 'required',
      ]);

      $paciente=Paciente::create($request->all());

      return redirect('paciente')->with('Listo', 'paciente creado correctamente');

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
        $paciente = Paciente::findOrFail($id);

        return view('paciente.edit', [
            'paciente' => $paciente
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
            'apellido' => 'required',
            'fecha_nacimiento' => 'nullable',
            'genero' => 'required',
            'telefono' => 'required',
            'correo' => 'nullable'
        ]);

        $paciente= Paciente::whereId($id)->update($validatedData);

        return redirect('paciente')->with('Listo', 'Paciente editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        
        $paciente->estado = 0;
        $paciente->update();

        return redirect('paciente')->with('Listo', 'Paciente eliminado correctamente');
    }
}
