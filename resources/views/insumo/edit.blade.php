@extends('adminlte::page')

@section('title', 'Editar Insumo')

@section('content_header')
    <!--h1>Editar insumo</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar Insumo</h3>
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
      <form method="post" action="{{ route('insumo.update', $insumo->id ) }}">
        <div class="form-group">
          <label for="cases">
            <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
            Tipo de Insumo:</label>
          <select class="form-control @error('id_tipo_insumo') is-invalid @enderror" name="id_tipo_insumo" id="id_tipo_insumo">
              @foreach($tipo_insumos as $tipo_insumo)
                  <option value="{{ $tipo_insumo->id }}" {{ $tipo_insumo->id==$insumo->id_tipo_insumo ? 'selected':''}}>{{ $tipo_insumo->nombre }}</option>
              @endforeach
          </select>
        </div>  
        <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Código:</label>
            <input type="text" class="form-control" name="codigo" value="{{ $insumo->codigo }}"/>
        </div>
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="{{ $insumo->nombre }}"/>
          </div>
          
          <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Es reactivo:</label>
            <select class="form-control @error('es_reactivo') is-invalid @enderror" name="es_reactivo" id="es_reactivo">
              <option disabled selected>Seleccione si es reactivo</option>
              <option value="0" {{ $insumo->es_reactivo == '0' ? 'selected' : '' }}>No reactivo</option>
              <option value="1" {{ $insumo->es_reactivo == '1' ? 'selected' : '' }}>Reactivo</option>
          </select>
          </div>
          
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="{{ route('insumo.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
        </form>
  </div>
</div>
@stop