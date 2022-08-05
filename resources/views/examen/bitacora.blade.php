@extends('adminlte::page')

@section('title', 'Consultar exámenes')

@section('content_header')
    <h1 style="align-content: center">Consultar exámenes</h1>
@stop

@section('content')
    <table id="table1" class="table table-striped shadow-lg mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th>Nó.</th>
                <th>Tipo Exámen</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Valor exámen</th>
                <th>Examen pagado</th>
                <th>Técnico</th>
                <th>Médico Referente</th>
                <th>Motivo</th>
                <th>Tiempo</th>
                <th style="text-align: center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examenes as $examen)
           
            <tr>
                <td>{{$examen->id}}</td>
                <td>{{$examen->tipo_examen ?
                    $examen->tipo_examen->nombre:""}}
                </td>
                <td>{{$examen->fecha}}</td>
                <td>{{$examen->paciente ?
                    $examen->paciente->nombre.' '.$examen->paciente->apellido:""}}</td>
                <td>{{$examen->valor_examen}}</td>
                <td>@if ( $examen->examen_pagado == 1) Si
                    @else No
                    @endif</td>
                <td>{{$examen->tecnico ?
                    $examen->tecnico->nombre:""}}</td>
                <td>{{$examen->medico_referente ?
                    $examen->medico_referente->nombre:""}}</td>
                <td>{{$examen->motivo}}</td>
                <td>{{$examen->tiempo_estimado_respuesta}}</td>
                
                    
                
                 <td>
                    
                    <div class="form-group row">
                        <div class="col-sm-4">  
                            <button onclick="generarTicket('{{$examen->paciente ? $examen->paciente->nombre.' '.$examen->paciente->apellido:''}}','{{$examen->tiempo_estimado_respuesta}}', '{{$examen->tipo_examen ? $examen->tipo_examen->nombre:''}}', '{{$examen->valor_examen}}','{{$examen->fecha}}', '{{( $examen->examen_pagado)}}')"  class="btn btn-warning" type="submit"><i class="fas fa-print"></i></button>
                        </div>
                        <div class="col-sm-4">  
                            <button onclick="generarResultado('{{$examen->paciente ? $examen->paciente->nombre.' '.$examen->paciente->apellido:''}}','{{$examen->tiempo_estimado_respuesta}}', '{{$examen->tipo_examen ? $examen->tipo_examen->nombre:''}}','{{$examen->fecha}}', '{{$examen->medico_referente ? $examen->medico_referente->nombre:''}}','{{$examen->paciente ? $examen->paciente->fecha_nacimiento:''}}','{{$examen->paciente ? $examen->paciente->telefono:''}}','{{$examen->paciente ? $examen->paciente->genero:''}}')"  class="btn btn-primary" type="submit"><i class="fas fa-file-alt"></i></button>
                        </div>
                        <div class="col-sm-4">
                            <form action="{{ route('examen.show', $examen->id)}}" method="get">
                               
                               <button class="btn btn-secondary" type="submit"><span class="fas fa-eye"></span></button>
                                                       
                            </form>
                           </div>
                        <div class="col-sm-4">
                     <form action="{{ route('examen.destroy', $examen->id)}}" method="post">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                     </form>
                    </div>
                </div>
                 </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    {{-- Add insumo button --}}
    <a href="{{ route('examen.index')}}" class="btn btn-primary">
        <span class="fas fa-clipboard-check"></span>
        Ir realizar examen
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
    <script>
        function examenPagado(examen){
            if(examen_pagado = 1){
                let pagado;
                return pagado = "Si";
            }else{
               let pagado;
                return pagado = "No";
            }
        }
    </script>
    <script>
        function generarTicket(nombre_paciente, tiempo_estimado, nombre_examen, valor_examen, fecha, examen_pagado){
	    try{
        let pagado= examenPagado(examen_pagado);
		let ventana = window.open('', 'PRINT', 'height=420px,width=350px');
		let documento = ventana.document;
		documento.write("<html>");
		documento.write("<title>Ticket de Examen</title>");
		documento.write("<link rel='stylesheet' type='text/css' href='{{ asset('/css/estilos_ticket.css') }}' />");
		documento.write("<body>");
        documento.write("<div class='ticket; centrado'>");
        documento.write("<h1 class='centrado'>Ticket de examen </h1>")
        documento.write("<img src='/img/logolab.jpeg' alt='Logotipo' </img>")
        documento.write('<h3>LABORATORIO CLINICO "JIREH" </h3>')
		documento.write("<div id='contenedor-body'>");
        documento.write("<p class='italico'> 16 Av. 12- 40, Zona 1, Centro médico Concepción Zacapa <br> Tel.: 7941-0566 - WhatsApp: 4517-6935 <br> Emergencias: 5305-2564</p>")
		documento.write("Paciente: " + nombre_paciente);
        documento.write('<br>')
        documento.write("Fecha y tiempo en resultado: " + tiempo_estimado);
       // documento.write('<br>')
      //  documento.write("Examen: " + nombre_examen);
        documento.write('<br>')
        documento.write("Examen pagado: " + pagado);
        documento.write('<br>')
        documento.write("Precio: " + valor_examen);
		documento.write("</div>");
        documento.write("<p class='centrado'>¡GRACIAS POR SU PREFERENCIA!<br>labcentromedicojireh@yahoo.com </p>")
        documento.write("Fecha en que lo realizo: " + fecha);
        documento.write('</div>');
		documento.write('</body>');
		documento.write('</html>');
		documento.close();
		ventana.blur();
		//ventana.print();
	}catch(error){
		console.log("Error generando ticket: " + error);
	}	
    }
    </script>
    <script>
   /* function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}*/
    function calcularEdad(fecha) {
        if ( fecha == '') {
         return '';
        }
        // Si la fecha es correcta, calculamos la edad

        if (typeof fecha != "string" && fecha && esNumero(fecha.getTime())) {
            fecha = formatDate(fecha, "yyyy-MM-dd");
        }

        var values = fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth() + 1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if (ahora_mes < mes) {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)) {
            edad--;
        }
        if (edad > 1900) {
            edad -= 1900;
        }

        // calculamos los meses
        var meses = 0;

        if (ahora_mes > mes && dia > ahora_dia)
            meses = ahora_mes - mes - 1;
        else if (ahora_mes > mes)
            meses = ahora_mes - mes
        if (ahora_mes < mes && dia < ahora_dia)
            meses = 12 - (mes - ahora_mes);
        else if (ahora_mes < mes)
            meses = 12 - (mes - ahora_mes + 1);
        if (ahora_mes == mes && dia > ahora_dia)
            meses = 11;

        // calculamos los dias
        var dias = 0;
        if (ahora_dia > dia)
            dias = ahora_dia - dia;
        if (ahora_dia < dia) {
            ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
            dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
        }

        return edad + " años, " + meses + " meses y " + dias + " días";
    }

    </script>
    <script>
        
        function generarResultado(nombre_paciente, tiempo_estimado, nombre_examen, fecha, medico, fecha_nacimiento, telefono, genero, ){
        try{
        var age= calcularEdad(fecha_nacimiento); //Here you enter the year
        //var age = calculateAge("fecha_nacimiento");
        let ventana = window.open('', 'PRINT', 'height=820px,width=1050px');
		let documento = ventana.document;
		documento.write("<html>");
		documento.write("<title>Resultado Examen</title>");
		documento.write("<link rel='stylesheet' type='text/css' href='{{ asset('/css/estilos_resultado.css') }}' />");
		documento.write("<body>");
        documento.write("<img src='/img/laboratorio.png' alt='Logotipo' style='float: left'></img>" )
        documento.write("<div class='ticket'>");
        documento.write("<div class='centrado'>");
        documento.write('<h1 class="titulo">LABORATORIO CLINICO <br>"JIREH"</h1>')
        documento.write("<p class='centrado; italico'> 16 Av. 12- 40, Zona 1, Centro médico Concepción Zacapa<br>Tel.: 7941-0566 - WhatsApp: 4517-6935 - Emergencias: 5305-2564 <br>")
        documento.write("labcentromedicojireh@yahoo.com<br>Licda. Sofía López Gálvez / Química Bióloga - Col. 5473 </p>")
        documento.write("</div>");
        documento.write('<br>')
        documento.write('<br>')
		documento.write("Fecha ingreso: " + fecha);
        documento.write('<br>')
        documento.write("Fecha entrega: " + tiempo_estimado);
        documento.write('<br>')
        documento.write("Paciente: " + nombre_paciente);
        documento.write('<br>')
        documento.write("Médico: " + medico);
        documento.write('<br>')
        documento.write("Edad: " + age);
        documento.write('<br>')
        documento.write("Genero: " + genero + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono: "+ telefono);
        documento.write()
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<hr size="1px" color="#241D92">')
        documento.write("<p class='izquierdo'>EXAMEN SOLICITADO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RESULTADO &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VALORES DE REFERENCIA</p>");
        documento.write(nombre_examen)
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write('<br>')
        documento.write("<div class='derecho'>");
        documento.write('<hr align="right" size="1px"  width="25%" color="#241D92">')
        documento.write("<p align='right'>Responsable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>");
        documento.write('<br>')
        documento.write("</div'>");
        documento.write("<p align='center'>He aquí que yo les traeré sanidad y medicina; y los curaré y les revelaré abundancia de paz y de verdad. <br>JEREMIAS 33:6 </p>")
        documento.write('</div>');
		documento.write('</body>');
		documento.write('</html>');
		documento.close();
		ventana.blur();
		//ventana.print();
	}catch(error){
		console.log("Error generando ticket: " + error);
	}	
    }
    </script>
@stop