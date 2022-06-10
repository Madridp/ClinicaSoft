@extends('adminlte::page')

@section('title', 'Editar Paciente')

@section('content_header')
    <h1>Editar paciente</h1>
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    Editar Paciente
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
      <form method="post" action="{{ route('paciente.update', $paciente->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="{{ $paciente->nombre }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Apellido:</label>
              <input type="text" class="form-control" name="apellido" value="{{ $paciente->apellido }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Fecha Nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Genero:</label>
            <select class="form-control @error('genero') is-invalid @enderror" name="genero" id="genero">
              <option value="masculino">Masculino</option>
              <option value="femenino">Femenino</option>
          </select>
          </div>
          <div class="form-group">
            <label for="cases">Telefono:</label>
            <input type="number" class="form-control" name="telefono" value="{{ $paciente->telefono }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Correo:</label>
            <input type="email" class="form-control" name="correo" value="{{ $paciente->correo }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="javascript:history.back()" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Regresar
        </a>
        </form>
  </div>
</div>
@stop