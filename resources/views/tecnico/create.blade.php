@extends('adminlte::page')

@section('title', 'Registrar técnico')

@section('content_header')
    <!--h1>Registrar paciente</h1-->
@stop

@section('content')
<div class="card uper">
    <div class="card-header">
        <h3>Registrar Técnico</h3>
      </div>
    <div class="card-body">
    <form action="{{ route('tecnico.store') }}" method="post">
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

        {{-- DPI field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fa fa-address-book {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="text" name="dpi" class="form-control @error('dpi') is-invalid @enderror"
                value="{{ old('dpi') }}" placeholder="DPI">

           

            @error('dpi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

       {{-- Fecha de nacimiento field--}}
       <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                value="{{ old('fecha_nacimiento') }}" placeholder="Fecha de Nacimiento">

            

            @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- Telefono field--}}
       <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fa fa-phone-square {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="number" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono') }}" placeholder="Telefono">

          

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- correo field--}}
       <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                value="{{ old('correo') }}" placeholder="Correo">

           

            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        

        {{-- Register button --}}
        <button type="submit" class="btn {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            Registrar paciente
        </button>

        <a  href="{{ route('tecnico.index')}}" class="btn btn-danger">
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