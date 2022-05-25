@extends('adminlte::page')

@section('title', 'Consultar usuarios')

@section('content_header')
    <h1 style="align-content: center">Consultar usuarios</h1>
@stop

@section('content')
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nó.</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->id_rol}}</td>
                <td>Editar   |    Borrar</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop