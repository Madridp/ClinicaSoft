@extends('adminlte::page')

@section('title', 'Ver compra')

@section('content_header')
    <h1 style="align-content: center">Ver Compra</h1>
@stop

@section('content')
    
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-money-check-alt">
                            <label class="form-label" for="select-tipo-compra">Seleccione tipo compra:</label>
                        </span>
                        
                        
                    </div>
                </div>
                    <select class="form-control @error('id_tipo_compra') is-invalid @enderror" name="id_tipo_compra" id="select-tipo-compra">
                        <option disabled selected>Seleccione un tipo de compra</option>
                        @foreach($tipo_compra as $tipo_compras)
                  <option  disabled value="{{ $tipo_compras->id }}" {{ $tipo_compras->id==$compra->id_tipo_compra ? 'selected':''}}>{{ $tipo_compras->nombre }}</option>
                    @endforeach
                    </select>
    
                @error('id_tipo_compra')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                       
                        <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-no-factura">No. factura: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="number"
                    name="no_factura"
                    id="input-no-factura"
                    placeholder="No. fatura"
                    value="{{ $compra->no_factura }}"
                    readonly
                />
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-dias-credito">Días crédito: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="number"
                    name="dias_credito"
                    id="input-dias-credito"
                    placeholder="Días de credito"
                    min="0"
                    step="1"
                    readonly
                    value="{{ $compra->dias_credito }}"
                />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-calendar-check">
                            <label class="form-label" for="input-fecha-compra">Fecha compra:</label>
                        </span>
                    </div>
                </div>
                <input class="form-control @error('fecha_compra') is-invalid @enderror"
                    type="date"
                    name="fecha_compra"
                    id="input-fecha-compra"
                    value="{{ $compra->fecha_compra }}"
                    readonly
                />

                @error('fecha_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="far fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-fecha-recibe">Fecha recibe:</label></span>     
                    </div>
                </div>
                
                <input class="form-control"
                    type="date"
                    name="fecha_recibe"
                    id="input-fecha-recibe"
                    value="{{ $compra->fecha_recibe }}"
                    readonly
                />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="far fa-handshake {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="select-proveedor">Seleccione proveedor:</label></span>
                    </div>
                </div>
                
                <select class="form-control @error('id_proveedor') is-invalid @enderror" name="id_proveedor" id="select-proveedor">
                    <option disabled selected>Seleccione un proveedor</option>
                    @foreach($proveedor as $provedor)
                  <option  disabled value="{{ $provedor->id }}" {{ $provedor->id==$compra->id_proveedor ? 'selected':''}}>{{ $provedor->nombre }}</option>
              @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-money-bill {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-total-compra">Total compra:</label></span>
                    </div>
                </div>
                
                <input class="form-control @error('total_compra') is-invalid @enderror"
                    type="number"
                    name="total_compra"
                    id="input-total-compra"
                    placeholder="Total compra"
                    value="{{$compra->total_compra}}"
                    readonly
                />
                @error('total_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        
        <br />
        <br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Fecha vencimiento</th>
                <th>Insumo</th>
                <th>No. Lote</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
                
            </tr>
        </thead>
        <tbody id="tbody-detalles">
            @foreach ($loteInsumo as $lote)
            <tr>
                <td>{{$lote->fecha_vencimiento}}</td>
                <td>{{$lote->insumo ?
                    $lote->insumo->nombre:""}}</td>
                <td>{{$lote->no_lote}}</td>
                <td>{{$lote->cantidad}}</td>
                <td>{{$lote->precio_compra}}</td>
                <td>{{$lote->subtotal}}</td>
                 
            </tr>
            @endforeach
        </tbody>
    </table>
    <br />
    <br />
    <input hidden type="text" name="lista_detalle" id="input-lista-detalle">
        <br />
        <br />
        <div class="row">
            <div class="col-sm-4">
                <a  href="javascript: history.go(-1)" class="btn btn-primary">
                    <span class="fas fa-undo"></span>
                   Regresar a Compras
                </a>
                </div>
           
            <div class="col-sm-4">
            <a  href="{{ route('admin')}}" class="btn btn-danger">
                <span class="fas fa-home"></span>
               Dashboard
            </a>
            </div>
        </div>
 

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop