<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\TipoCompra;
use App\Models\Insumo;
use App\Models\DeudaProveedor;
use App\Models\LoteInsumo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompraController extends Controller
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
        //$compras = Compra::where('estado', '=', 1)->get();

        $tipo_compra = TipoCompra::all();
        $proveedor = Proveedor::all();
        $insumos = Insumo::all();
        return view('compra.index', [
            'tipo_compra' => $tipo_compra,
            'proveedor' => $proveedor,
            'insumos' => $insumos,
            //'compras' => $compras
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
        $proveedor = Proveedor::all();

        
        $tipo_compra = TipoCompra::all();
        return view('compra.create', [
            'tipo_compra' => $tipo_compra,
           
            'proveedor' => $proveedor
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
        $this->validate($request, [
            'id_tipo_compra' => 'required',
            'no_factura' => 'nullable|max:45',
            'dias_credito' => 'nullable|integer',
            'fecha_compra' => 'required',
            'fecha_recibe' => 'nullable',
            'id_proveedor' => 'required',
            'total_compra' => 'required|gt:0',
        ]);

        DB::beginTransaction();

        try{
            $compra = Compra::create($request->all());

            if ( $compra->id_tipo_compra == 2 && $compra->no_factura == null ){
                DB::rollBack();
                throw new Exception('Debe indicarse la factura, cuando la compra es al crédito.');
            }

            $lista_detalles = json_decode($request->get('lista_detalle'), true);

            if(!is_countable($lista_detalles)){
                DB::rollBack();
                throw new Exception('No se pudo obtener la lista de detalles compra.');
            }

            foreach($lista_detalles as $detalle){
                $loteInsumo = new LoteInsumo();

                $loteInsumo->id_compra = $compra->id;
                $loteInsumo->fecha_vencimiento = $detalle['fecha_vencimiento'] ? $detalle['fecha_vencimiento'] : null;
                $loteInsumo->id_insumo = $detalle['insumo_id'];
                $loteInsumo->no_lote = $detalle['no_lote'];
                $loteInsumo->cantidad = $detalle['cantidad'];
                $loteInsumo->existencia = $loteInsumo->cantidad;
                $loteInsumo->precio_compra = $detalle['precio_compra'];
                $loteInsumo->descuento = 0;
                $loteInsumo->subtotal = ($loteInsumo->precio_compra * $loteInsumo->cantidad) - $loteInsumo->descuento;
                $loteInsumo->estado = 1;
                $loteInsumo->save();
            }


            // si se indica proveedor, se registra un dato a deuda proveedor
            // y tambien si la compra es al credito
            if ( $compra->id_proveedor && $compra->id_tipo_compra == 2 ){
                $deudaProveedor = new DeudaProveedor();
                $deudaProveedor->id_proveedor = $compra->id_proveedor;
                $deudaProveedor->id_compra = $compra->id;
                $deudaProveedor->debe = $compra->total_compra;
                $deudaProveedor->haber = 0;
                $deudaProveedor->saldo = $deudaProveedor->debe;
                $deudaProveedor->descripcion = 'COMPRA #' . $compra->id . ', FACT: ' . $compra->no_factura;
                $deudaProveedor->estado = 1;
                $deudaProveedor->save();
            }

            DB::commit();
        }catch(Exception|Throwable $e){
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('compra.index')->with('exito', 'Compra creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( Auth::user()->id_rol == 3 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $proveedor = Proveedor::all();
        $compra = Compra::findOrFail($id);
        $tipo_compra = TipoCompra::where('estado', '=', 1)->get();
        $insumos = Insumo::all();
        $loteInsumo = LoteInsumo::where('id_compra', '=', $compra->id)->get();

        return view('compra.show', [
            'proveedor' => $proveedor,
            'compra' => $compra,
            'tipo_compra' => $tipo_compra,
            'insumos' => $insumos,
            'loteInsumo' => $loteInsumo
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
        $validatedData = $request->validate([
            'id_proveedor' => 'nullable',
            'fecha_compra' => 'required',
            'fecha_recibe' => 'nullable',
            'total_compra' => 'required',
            'no_factura' => 'nullable',
            'id_tipo_compra' => 'required',
            'dias_credito' => 'nullable'
        ]);

        $compra= Compra::whereId($id)->update($validatedData);

        return redirect('compra')->with('Listo', 'compra editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        
        $compra->estado = 0;
        $compra->update();

        return redirect('compra/bitacora')->with('Listo', 'compra eliminada correctamente');
    }
    
   public function bitacora(){
        //-------------------------

        if ( Auth::user()->id_rol == 3 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $compras = Compra::where('estado', '=', 1)->get();

        return view('compra.bitacora', [
            'compras' => $compras,
        ]);
   }
}
