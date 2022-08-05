@extends('adminlte::page')

@section('title', 'Consultar Tipo de Compra')

@section('content_header')
    <h1 style="align-content: center">Consultar tipo de Compra</h1>
@stop

@section('content')
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nó.</th>
                <th>Nombre</th>
                <!--th></th>
                <th>Acciones</th-->
            </tr>
        </thead>
        <tbody>
            @foreach ($tipoCompras as $tipoCompra)
            <tr>
                <td>{{$tipoCompra->id}}</td>
                <td>{{$tipoCompra->nombre}}</td>
                 <!--td><a href="{{ route('tipoCompra.edit', $tipoCompra->id)}}" class="btn btn-primary">Editar</a--></td>
                 <!--td>
                     <form action="{{ route('tipoCompra.destroy', $tipoCompra->id)}}" method="post">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-danger" type="submit">Eliminar</button-->
                     </form>
                 <!--/td-->
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Add paciente button --}}
    <!--a href="{{ route('tipoCompra.create')}}" class="btn btn-primary">
        <span class="fas fa-user-plus"></span>
        Agregar tipo de compra
    </a--></td>
    <a  href="{{ route('admin')}}" class="btn btn-danger">
        <span class="fas fa-undo"></span>
       Regresar
    </a>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop