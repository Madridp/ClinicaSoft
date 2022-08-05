@extends('adminlte::page')

@section('title', 'Consultar usuarios')

@section('content_header')
    <h1 style="align-content: center">Consultar usuarios</h1>
@stop

@section('content')
    <table id="table1" class="table table-striped shadow-lg mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th>Nó.</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->rol ?
                    $user->rol->nombre:""}}</td>
                 <td>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            @if ( Auth::user()->id_rol == 1)
                    <a href="{{ route('usuario.edit', $user->id)}}" class="btn btn-primary">Editar</a>
                </div>
                <div class="col-sm-4">
                     <form action="{{ route('usuario.destroy', $user->id)}}" method="post">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-danger" type="submit">Eliminar</button>
                       @endif
                     </form>
                    </div>     
                </div>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Add usuario button --}}
    @if ( Auth::user()->id_rol == 1)
    <a href="{{ route('usuario.create')}}" class="btn btn-primary">
        <span class="fas fa-user-plus"></span>
        Agregar usuario
    </a></td>
    @endif
    <a  href="{{ route('admin')}}" class="btn btn-danger">
        <span class="fas fa-undo"></span>
       Regresar
    </a>
    
@stop

@section('css')
     <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> 
@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js">
</script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">   
</script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">  
</script>




    <script>
        $(document).ready(function () {
            $('#table1').DataTable({
                "language": {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                    },
                    oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
            }
        }
            );
 
        });
    </script>
         
@stop