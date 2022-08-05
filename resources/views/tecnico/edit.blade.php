@extends('adminlte::page')

@section('title', 'Editar Técnico')

@section('content_header')
    <!--h1>Editar tecnico</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar Técnico</h3>
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
      <form method="post" action="{{ route('tecnico.update', $tecnico->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="{{ $tecnico->nombre }}"/>
          </div>
          <div class="form-group">
              <label for="cases">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                DPI:</label>
              <input type="text" class="form-control" name="dpi" value="{{ $tecnico->dpi }}"/>
          </div>
          <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Fecha Nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $tecnico->fecha_nacimiento }}"/>
          </div>
          <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Telefono:</label>
            <input type="number" class="form-control" name="telefono" value="{{ $tecnico->telefono }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Correo:</label>
            <input type="email" class="form-control" name="correo" value="{{ $tecnico->correo }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="{{ route('tecnico.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
        </form>
  </div>
</div>
@stop