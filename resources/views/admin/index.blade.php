@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lab Clinico Jireh</h1>
@stop

@section('content')
    <p>Bienvenidos al panel del administrador.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        Swal.fire(
            'Bienvenido!',
            '',
            'success'
        )
    </script>
@stop