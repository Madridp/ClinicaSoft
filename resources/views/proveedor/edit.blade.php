@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <!--h1>Editar proveedor</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar Proveedor</h3>
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
      <form method="post" action="{{ route('proveedor.update', $proveedor->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="{{ $proveedor->nombre }}"/>
          </div>
          <div class="form-group">
              <label for="cases">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                NIT:</label>
              <input type="number" class="form-control" name="nit" value="{{ $proveedor->nit }}"/>
          </div>
          <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Telefono:</label>
            <input type="number" class="form-control" name="telefono" value="{{ $proveedor->telefono }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Correo:</label>
            <input type="email" class="form-control" name="correo" value="{{ $proveedor->correo }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a  href="{{ route('proveedor.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
        </form>
  </div>
</div>
@stop