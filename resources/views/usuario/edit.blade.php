@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <!--h1>Editar usuario</h1-->
@stop

@section('content')

<div class="card uper">
  <div class="card-header">
    <h3>Editar Usuario</h3>
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
      <form method="post" action="{{ route('usuario.update', $user->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Nombre:</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
          </div>
          <div class="form-group">
              <label for="cases">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
          </div>
          <div class="form-group">
            <label for="cases">
              
              Cambiar contraseña: (Opcional)</label>
            <input type="password" class="form-control" name="password" placeholder="Cambiar contraseña"/>
        </div>
        <div class="form-group">
          <label for="cases">
            
            Confirmar contraseña: (Opcional)</label>
          <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña"/>
      </div>
          <div class="form-group">
            <label for="cases">
              <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
              Rol:</label>
            <select class="form-control @error('id_rol') is-invalid @enderror" name="id_rol" id="id_rol">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $rol->id==$user->id_rol ? 'selected':'' }}>{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>

          <a  href="{{ route('usuario.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>
      </form>
      
  </div>
</div>
@stop