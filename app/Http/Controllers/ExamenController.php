<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoExamen;
use App\Models\Examen;
use App\Models\LoteInsumo;
use App\Models\MedicoReferente;
use App\Models\Paciente;
use App\Models\ProcesoExamen;
use App\Models\Tecnico;
use App\Models\TipoExamen;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ExamenController extends Controller
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
        

        $tipo_examen = TipoExamen::all();
        $paciente = Paciente::all();
        $tecnico = Tecnico::all();
        $medico = MedicoReferente::all();
        $usuario = User::all();
        return view('examen.index', [
            'tipo_examen' => $tipo_examen,
            'paciente' => $paciente,
            'tecnico' => $tecnico,
            'medico' => $medico,
            'usuario' => $usuario,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           // 'id_tipo_examen' => 'required',
            'fecha' => 'required',
            'id_paciente' => 'required',
            'valor_examen' => 'required|gt:0',
            'examen_pagado' => 'required|gt:0',
            'id_tecnico' => 'required',
            'id_medico_referente' => 'nullable',
            'motivo' => 'required',
            'adjunto_orden' => 'nullable',
            'tiempo_estimado_respuesta' => 'nullable',
            'documento_resultado' => 'nullable',
            'id_usuario' => 'nullable',
        ]);

       // $examen = Examen::create($request->all());
        DB::beginTransaction();

     try{
            $examen = Examen::create($request->all());

           $lista_detalles = json_decode($request->get('lista_detalle'), true);

            if(!is_countable($lista_detalles)){
                DB::rollBack();
                throw new Exception('No se pudo obtener la lista de detalles del examen.');
            }

        //    return response()->json($lista_detalles);
            /*foreach($lista_detalles as $detalle){
                $detalleExamen = new DetalleTipoExamen();

                $detalleExamen->id_examen = $examen->id;
                $detalleExamen->id_tipo_examen = $examen->id_tipo_examen;
                $detalleExamen->tipo_examen = $detalle['tipo_examen'];
                $detalleExamen->valor_examen = $detalle['valor_examen'];
                $detalleExamen->descuento = 0;
                $detalleExamen->total_examen = ($detalleExamen->valor_examen ++) - $detalleExamen->descuento;
                
                
                $detalleExamen->estado = 1;
                $detalleExamen->save();
            }*/

            foreach($lista_detalles as $detalle){
                $detalleExaxmen = new DetalleTipoExamen();
                $detalleExaxmen->id_examen = $examen->id;
                $detalleExaxmen->id_tipo_examen = $detalle['id_tipo_examen']; // se agrega en javascript
                $detalleExaxmen->valor_examen = $detalle['valor_examen']; // se agrega en javascript
                $detalleExaxmen->descuento = 0;
                $detalleExaxmen->total_examen = $detalleExaxmen->valor_examen - $detalleExaxmen->descuento;
                $detalleExaxmen->estado = 1;
                $detalleExaxmen->save();

                
            }

            
            
              /*  $detalleExamen = new DetalleTipoExamen();
                $detalleExamen->id_tipo_examen = $tipo_examen->id;
                $detalleExamen->id_examen = $examen->id;
                $detalleExamen->saldo = $detalleExamen->debe;
                $detalleExamen->descripcion = 'Examen #' . $examen->id . ', FACT: ' . $examen->no_factura;
                $detalleExamen->estado = 1;
                $detalleExamen->save();*/
            

            DB::commit();
        }catch(Exception|Throwable $e){
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
        
        return redirect()->route('examen.index')->with('exito', 'Examen creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::all();
        $examen = Examen::findOrFail($id);
        $tipo_examen = TipoExamen::where('estado', '=', 1)->get();
        $tecnico = Tecnico::all();
        $medico = MedicoReferente::all();
        $usuario = User::all();
        $detalleExamen = DetalleTipoExamen::where('id_examen', '=', $examen->id)->get();

        return view('examen.show', [
            'paciente' => $paciente,
            'examen' => $examen,
            'tipo_examen' => $tipo_examen,
            'tecnico' => $tecnico,
            'medico' => $medico,
            'usuario' => $usuario,
            'detalleExamen' => $detalleExamen,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $proveedor = Proveedor::all();
        $compra = Compra::findOrFail($id);
        $tipo_compra = TipoCompra::where('estado', '=', 1)->get();

        return view('compra.edit', [
            'proveedor' => $proveedor,
            'compra' => $compra,
            'tipo_compra' => $tipo_compra,
        ]);*/
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::findOrFail($id);
        
        $examen->estado = 0;
        $examen->update();

        return redirect('examen/bitacora')->with('Listo', 'compra eliminada correctamente');
    }
    
   public function bitacora(){
        //-------------------------

        $examenes = Examen::where('estado', '=', 1)->get();
       // $detalleExamen = DetalleTipoExamen::where('id_examen', '=', $examenes->id)->get();

        return view('examen.bitacora', [
            'examenes' => $examenes,
           // 'detalleExamen' => $detalleExamen,
        ]);
   }
}
