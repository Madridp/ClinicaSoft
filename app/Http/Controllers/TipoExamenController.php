<?php

namespace App\Http\Controllers;

use App\Models\TipoExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoExamenController extends Controller
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
        $tipoExamenes = TipoExamen::where('estado', '=', 1)->get();

        return view('tipoExamen.index', [
            'tipoExamenes' => $tipoExamenes
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
      return view('tipoExamen.create');
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

      $tipoExamen=TipoExamen::create($request->all());

      return redirect('tipoExamen')->with('Listo', 'tipo de examen creado correctamente');

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
        $tipoExamen = TipoExamen::findOrFail($id);

        return view('tipoExamen.edit', [
            'tipoExamen' => $tipoExamen
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
            'descripcion' => 'nullable'
        ]);

        $tipoExamen= TipoExamen::whereId($id)->update($validatedData);

        return redirect('tipoExamen')->with('Listo', 'tipo de examen editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoExamen = TipoExamen::findOrFail($id);
        
        $tipoExamen->estado = 0;
        $tipoExamen->update();

        return redirect('tipoExamen')->with('Listo', 'tipo de examen eliminado correctamente');
    }
}
