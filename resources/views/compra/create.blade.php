@extends('adminlte::page')

@section('title', 'Registrar compra')

@section('content_header')
    <!--h1>Registrar paciente</h1-->
@stop

@section('content')
<div class="card uper">
    <div class="card-header">
        <h3>Registrar Compra</h3>
      </div>
    <div class="card-body">
    <form action="{{ route('compra.store') }}" method="post">
        @csrf

        {{-- Proveedor field--}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    
                    <span class="far fa-handshake {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
                <select class="form-control @error('id_proveedor') is-invalid @enderror" name="id_proveedor" id="id_proveedor">
                    <option disabled selected>Seleccione un proveedor</option>
                    @foreach($proveedor as $provedor)
                    <option value="{{ $provedor->id }}">{{ $provedor->nombre }}</option>
                    @endforeach
                </select>

            @error('id_proveedor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="">Fecha compra: </label>
        {{-- fecha compra field --}}
        <div class="input-group mb-3">
            
            <div class="input-group-append">
                <div class="input-group-text">
                   
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-calendar-check {{ config('adminlte.classes_auth_icon', '') }}"></span>
                       
                    
                </div>
            </div>
            <input type="date" name="fecha_compra" class="form-control @error('fecha_compra') is-invalid @enderror"
                value="{{ old('fecha_compra') }}" placeholder="Fecha compra" autofocus>


            @error('fecha_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="">Fecha recibe: </label>
        {{-- Fecha recibe field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                   
                        <span class="far fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        
                    
                </div>
            </div>
            <input type="date" name="fecha_recibe" class="form-control @error('fecha_recibe') is-invalid @enderror"
                value="{{ old('fecha_recibe') }}" placeholder="Fecha recibe" autofocus>


            @error('fecha_recibe')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- total compra field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-money-bill {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="number" name="total_compra" class="form-control @error('total_compra') is-invalid @enderror"
                value="{{ old('total_compra') }}" placeholder="Total compra" autofocus>


            @error('total_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- no factura field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                   
                    <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="text" name="no_factura" class="form-control @error('no_factura') is-invalid @enderror"
                value="{{ old('no_factura') }}" placeholder="Número factura" autofocus>


            @error('no_factura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
     
     
        {{-- tipo compra field--}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-money-check-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
                <select class="form-control @error('id_tipo_compra') is-invalid @enderror" name="id_tipo_compra" id="id_tipo_compra">
                    <option disabled selected>Seleccione un tipo de compra</option>
                    @foreach($tipo_compra as $compra)
                    <option value="{{ $compra->id }}">{{ $compra->nombre }}</option>
                    @endforeach
                </select>

            @error('id_tipo_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- dias credito field --}}
        <div class="input-group mb-3">
            <div class="input-group-append">
                <div class="input-group-text">
                    
                    <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            <input type="number" name="dias_credito" class="form-control @error('dias_credito') is-invalid @enderror"
                value="{{ old('dias_credito') }}" placeholder="Días crédito" autofocus>


            @error('dias_credito')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       

        {{-- Register button --}}
        <button type="submit" class="btn {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            Registrar compra
        </button>

        <a  href="{{ route('compra.index')}}" class="btn btn-danger">
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