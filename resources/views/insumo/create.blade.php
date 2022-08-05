@extends('adminlte::page')

@section('title', 'Registrar insumo')

@section('content_header')
    <!--h1>Registrar paciente</h1-->
@stop

@section('content')
<div class="card uper">
    <div class="card-header">
        <h3>Registrar Insumo</h3>
      </div>
    <div class="card-body">
    <form action="{{ route('insumo.store') }}" method="post">
        @csrf

        {{-- Tipo insumo field--}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-prescription-bottle-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
                <select class="form-control @error('id_tipo_insumo') is-invalid @enderror" name="id_tipo_insumo" id="id_tipo_insumo">
                    <option disabled selected>Seleccione un tipo de insumo</option>
                    @foreach($tipo_insumos as $tipo_insumo)
                    <option value="{{ $tipo_insumo->id }}">{{ $tipo_insumo->nombre }}</option>
                    @endforeach
                </select>

            @error('id_tipo_insumo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- Codigo field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-barcode {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                value="{{ old('codigo') }}" placeholder="Codigo" autofocus>


            @error('codigo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-file-medical {{ config('adminlte.classes_auth_icon', '') }}"></span>
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

        
        {{-- Es reactivo field--}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-flask {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
                <select class="form-control @error('es_reactivo') is-invalid @enderror" name="es_reactivo" id="es_reactivo">
                    <option disabled selected>Seleccione si es reactivo</option>
                    <option value='0'>No reactivo</option>
                    <option value='1'>Reactivo</option>
                </select>

            @error('es_reactivo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       

        {{-- Register button --}}
        <button type="submit" class="btn {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            Registrar insumo
        </button>

        <a  href="{{ route('insumo.index')}}" class="btn btn-danger">
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