<?php

namespace App\Http\Controllers;

use App\Models\TipoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoCompraController extends Controller
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
        $tipoCompras = TipoCompra::where('estado', '=', 1)->get();

        return view('tipoCompra.index', [
            'tipoCompras' => $tipoCompras
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
      return view('tipoCompra.create');
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

      $tipoCompra=TipoCompra::create($request->all());

      return redirect('tipoCompra')->with('Listo', 'tipo de compra creado correctamente');

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
        $tipoCompra = TipoCompra::findOrFail($id);

        return view('tipoCompra.edit', [
            'tipoCompra' => $tipoCompra
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

        $tipoCompra= TipoCompra::whereId($id)->update($validatedData);

        return redirect('tipoCompra')->with('Listo', 'tipo de compra editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoCompra = TipoCompra::findOrFail($id);
        
        $tipoCompra->estado = 0;
        $tipoCompra->update();

        return redirect('tipoCompra')->with('Listo', 'tipo de compra eliminado correctamente');
    }
}
