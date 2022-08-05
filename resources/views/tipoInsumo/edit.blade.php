@extends('adminlte::page')

@section('title', 'Editar tipo de insumo')

@section('content_header')
    <!--h1>Editar paciente</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar tipo de insumo</h3>
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
      <form method="post" action="{{ route('tipoInsumo.update', $tipoInsumo->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="{{ $tipoInsumo->nombre }}"/>
          </div>
          
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="{{ route('tipoInsumo.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
        </form>
  </div>
</div>
@stop