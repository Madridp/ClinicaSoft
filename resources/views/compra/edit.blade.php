@extends('adminlte::page')

@section('title', 'Editar Compra')

@section('content_header')
    <!--h1>Editar insumo</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar Compra</h3>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('compra.update', $compra->id ) }}">
        <div class="form-group">
          <label for="cases">
            @csrf
            @method('PATCH')
            <!--span class="input-group-addon" style="color:red; font-family: Verdana;">*</span-->
            Proveedor:</label>
          <select class="form-control @error('id_proveedor') is-invalid @enderror" name="id_proveedor" id="id_proveedor">
              @foreach($proveedor as $provedor)
                  <option value="{{ $provedor->id }}" {{ $provedor->id==$compra->id_proveedor ? 'selected':''}}>{{ $provedor->nombre }}</option>
              @endforeach
          </select>
        </div>  
        <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Fecha Compra:</label>
            <input type="date" class="form-control" name="fecha_compra" value="{{ $compra->fecha_compra }}"/>
        </div>

        <div class="form-group">
          <label for="cases">
            <!--span class="input-group-addon" style="color:red; font-family: Verdana;">*</span-->
            Fecha Recibe:</label>
          <input type="date" class="form-control" name="fecha_recibe" value="{{ $compra->fecha_recibe }}"/>
        </div>
         
        <div class="form-group">
          <label for="cases">
            <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
            Total Compra:</label>
          <input type="number" class="form-control" name="total_compra" value="{{ $compra->total_compra }}"/>
        </div>
          
        <div class="form-group">
          <label for="cases">
            <!--span class="input-group-addon" style="color:red; font-family: Verdana;">*</span-->
            Nó Factura:</label>
          <input type="text" class="form-control" name="no_factura" value="{{ $compra->no_factura }}"/>
        </div>

        <div class="form-group">
          <label for="cases">
            <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
            Tipo Compra:</label>
          <select class="form-control @error('id_tipo_compra') is-invalid @enderror" name="id_tipo_compra" id="id_tipo_compra">
              @foreach($tipo_compra as $tipo_compras)
                  <option value="{{ $tipo_compras->id }}" {{ $tipo_compras->id==$compra->id_tipo_compra ? 'selected':''}}>{{ $tipo_compras->nombre }}</option>
              @endforeach
          </select>
        </div>
        
        <div class="form-group">
          <label for="cases">
            <!--span class="input-group-addon" style="color:red; font-family: Verdana;">*</span-->
            Días crédito:</label>
          <input type="number" class="form-control" name="dias_credito" value="{{ $compra->dias_credito }}"/>
        </div>
         
          
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="{{ route('compra.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
        </form>
  </div>
</div>
@stop