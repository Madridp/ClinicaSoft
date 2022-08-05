@extends('adminlte::page')

@section('title', 'Registrar tipo de insumo')

@section('content_header')
    <!--h1>Registrar paciente</h1-->
@stop

@section('content')
<div class="card uper">
    <div class="card-header">
        <h3>Registrar tipo de insumo</h3>
      </div>
    <div class="card-body">
    <form action="{{ route('tipoInsumo.store') }}" method="post">
        @csrf

        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre') }}" placeholder="Nombre" autofocus>


            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            Registrar tipo de insumo
        </button>

        <a  href="{{ route('tipoInsumo.index')}}" class="btn btn-danger">
            <span class="fas fa-undo"></span>
            Cancelar
        </a>

    </form>
</div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop