@extends('adminlte::page')

@section('title', 'Consultar compras')

@section('content_header')
    <h1 style="align-content: center">Consultar compras</h1>
@stop

@section('content')
    <table id="table1" class="table table-striped shadow-lg mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th>Nó.</th>
                <th>Proveedor</th>
                <th>Fecha Compra</th>
                <th>Fecha Recibe</th>
                <th>Total Compra</th>
                <th>No. Factura</th>
                <th>Dias credito</th>
                <th style="text-align: center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
            <tr>
                <td>{{$compra->id}}</td>
                <td>{{$compra->proveedor ?
                    $compra->proveedor->nombre:""}}</td>
                <td>{{$compra->fecha_compra}}</td>
                <td>{{$compra->fecha_recibe}}</td>
                <td>{{$compra->total_compra}}</td>
                <td>{{$compra->no_factura}}</td>
                <td>{{$compra->dias_credito}}</td>
                
                    
                
                 <td>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <form action="{{ route('compra.show', $compra->id)}}" method="get">
                               
                               <button class="btn btn-secondary" type="submit"><span class="fas fa-eye">Ver</span></button>
                                                       
                            </form>
                           </div>
                        <div class="col-sm-6">
                     <form id="btn1" action="{{ route('compra.destroy', $compra->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                       <button id="btn1" class="btn btn-danger" type="submit">Eliminar</button>
                       
                     </form>
                    </div>
                </div>
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

<script src="https://unpkg.com/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>



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
    <!--script>
    document.querySelector("#btn1").addEventListener('click', function(){
        Swal
    .fire({
        title: "Compra ",
        text: "¿Eliminar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    })
    .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
            console.log("*se elimina la compra*");
        } else {
            // Dijeron que no
            console.log("*NO se elimina la compra*");
        }
    });
    });
    </script-->
@stop