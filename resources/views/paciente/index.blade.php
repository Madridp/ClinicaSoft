@extends('adminlte::page')

@section('title', 'Consultar Pacientes')

@section('content_header')
    <h1 style="align-content: center">Consultar pacientes</h1>
@stop

@section('content')
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nó.</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Género</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr>
                <td>{{$paciente->id}}</td>
                <td>{{$paciente->nombre}}</td>
                <td>{{$paciente->apellido}}</td>
                <td>{{$paciente->fecha_nacimiento}}</td>
                <td>{{$paciente->genero}}</td>
                <td>{{$paciente->telefono}}</td>
                <td>{{$paciente->correo}}</td>
                 <td><a href="{{ route('paciente.edit', $paciente->id)}}" class="btn btn-primary">Editar</a></td>
                 <td>
                     <form action="{{ route('paciente.destroy', $paciente->id)}}" method="post">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-danger" type="submit">Eliminar</button>
                     </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Add paciente button --}}
    <a href="{{ route('paciente.create', $paciente->id)}}" class="btn btn-primary">
        <span class="fas fa-user-plus"></span>
        Agregar paciente
    </a></td>
    <a href="javascript:history.back()" class="btn btn-danger">
        <span class="fas fa-undo"></span>
        Regresar
    </a></td>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop