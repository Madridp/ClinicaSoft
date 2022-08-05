@extends('adminlte::page')

@section('title', 'Consultar deudas de Proveedores')

@section('content_header')
    <h1 style="align-content: center">Consultar Deudas de Proveedores</h1>
@stop

@section('content')
    <table id="table1" class="table table-striped shadow-lg mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th>Nó.</th>
                <th>Proveedor</th>
                <th>Total Compra</th>
                <th>Debe</th>
                <th>Saldo</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deudaProveedor as $deuda)
            <tr>
                <td>{{$deuda->id}}</td>
                <td>{{$deuda->proveedor ?
                    $deuda->proveedor->nombre:""}}</td>
                <td>{{$deuda->compra ?
                    $deuda->compra->total_compra:""}}</td>
                <td>{{$deuda->debe}}</td>
                <td>{{$deuda->saldo}}</td>
                <td>{{$deuda->descripcion}}</td>
                
                 <td>
                     <form action="{{ route('deudaProveedor.destroy', $deuda->id)}}" method="post">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-danger" type="submit">Eliminar</button>
                     </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Add insumo button --}}
    <a href="{{ route('compra.index')}}" class="btn btn-primary">
        <span class="fas fa-clipboard-check"></span>
        Realizar compra
    </a></td>
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