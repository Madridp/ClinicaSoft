@extends('adminlte::page')

@section('title', 'Formulario Exámenes')

@section('content_header')
    <h1 style="align-content: center">Formulario Exámenes</h1>
@stop

@section('content')
    <form action="{{ route('examen.store') }}" method="post">
        @csrf
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="row">
            
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-fecha">Fecha:</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="date"
                    name="fecha"
                    id="input-fecha"
                    placeholder="Fecha"
                    @error('fecha') is-invalid @enderror
                />
                @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-user">
                            <label class="form-label" for="select-paciente">Seleccione Paciente:</label>
                        </span>
                        
                        
                    </div>
                </div>
                    <select class="form-control @error('id_paciente') is-invalid @enderror" name="id_paciente" id="select-paciente">
                        <option disabled selected>Seleccione Paciente</option>
                        @foreach($paciente as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre.' '.$paciente->apellido }}</option>
                        @endforeach
                    </select>
    
                @error('id_paciente')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-calendar-times {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-tiempo_estimado_respuesta">Tiempo estimado: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="datetime-local"
                    id="input-tiempo_estimado_respuesta"
                    name="tiempo_estimado_respuesta"
                />
            </div>
            <!---------------------------------------------------------------------->
        </div>
        <br>
        <div class="row">
            
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-prescription-bottle-alt">
                            <label class="form-label" for="select-examen-pagado">Examen pagado:</label>
                        </span>
                        
                        
                    </div>
                </div>
                    <select class="form-control @error('examen_pagado') is-invalid @enderror" name="examen_pagado" id="select-examen-pagado">
                        <option disabled selected>Seleccione examen pagado</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
    
                @error('examen_pagado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-syringe">
                            <label class="form-label" for="select-tecnico">Seleccione Tecnico:</label>
                        </span>
                        
                        
                    </div>
                </div>
                    <select class="form-control @error('id_tecnico') is-invalid @enderror" name="id_tecnico" id="select-tecnico">
                        <option disabled selected>Seleccione Tecnico</option>
                        @foreach($tecnico as $tecnico)
                        <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                        @endforeach
                    </select>
    
                @error('id_tecnico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="far fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-motivo">Motivo:</label></span>     
                    </div>
                </div>
                
                <input class="form-control"
                    type="text"
                    name="motivo"
                    id="input-motivo"
                    @error('motivo') is-invalid @enderror
                />
                @error('motivo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-user-md">
                            <label class="form-label" for="select-medico_referente">Seleccione Medico Referente:</label>
                        </span>
                        
                    </div>
                </div>
                    <select class="form-control @error('id_medico_referente') is-invalid @enderror" name="id_medico_referente" id="select-medico_referente">
                        <option disabled selected>Seleccione Medico Referente</option>
                        @foreach($medico as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nombre }}</option>
                        @endforeach
                    </select>
    
                @error('id_medico_referente')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-------------------------------------------------------------------------------------------->
            
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="far fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-adjunto_orden">Adjunto Orden: (Si aplica)</label></span>     
                    </div>
                </div>
                
                <input class="form-control"
                    type="file"
                    name="adjunto_orden"
                    id="input-adjunto_orden"
                />
                @error('adjunto_orden')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <br />
        <div class="row">
           
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-first-aid {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-documento_resultado">Documento resultado: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="file"
                    id="input-documento_resultado"
                    name="documento_resultado"
                />
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-money-bill {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-total-examen">Total examen:</label></span>
                    </div>
                </div>
                
                <input class="form-control @error('total_examen') is-invalid @enderror"
                    type="number"
                    name="valor_examen"
                    id="input-total-examen"
                    placeholder="Total examen"
                    readonly
                />
                @error('total_examen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <br />
        <h3>Detalle Examen</h3>
        <br />
        <div class="row">
        <div class="col-sm-4">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-money-check-alt">
                        <label class="form-label" for="select-tipo-examen">Seleccione tipo de examen:</label>
                    </span>
                    
                    
                </div>
            </div>
                <select class="form-control @error('id_tipo_examen') is-invalid @enderror" name="id_tipo_examen" id="select-tipo-examen">
                    <option disabled selected>Seleccione un tipo de examen</option>
                    @foreach($tipo_examen as $examen)
                    <option value="{{ $examen->id }}">{{ $examen->nombre }}</option>
                    @endforeach
                </select>

            @error('id_tipo_examen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                    <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-valor-examen">Valor examen:</label></span>
                </div>
            </div>
            
            <input class="form-control"
                type="number"
                
                id="input-valor-examen"
                placeholder="Valor examen"
                min="0"
                step="1"
                @error('valor_examen') is-invalid @enderror
            />
            @error('valor_examen')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <br />
            <button type="button" class="btn btn-primary" id="btn-agregar-detalles" onclick="agregarNuevoDetalle()">
                <span class="fas fa-file-medical"></span>
                Agregar detalle</button>
        </div>
            
        </div>
        <br>
        <br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Tipo de Examen</th>
                <th>Valor de examen</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-detalles">
        </tbody>
    </table>
    <br />
    <br />
    <input hidden type="text" name="lista_detalle" id="input-lista-detalle">
        <br />
        <br />
        <div class="row">
            <div class="col-sm-2">
                <button  id="btn1" class="btn btn-primary" type="submit">
                    <span class="fas fa-first-aid"></span>
                    Registrar examen
                    
                </button>
            </div>
            <div class="col-sm-2">
                <button  onclick="generarTicket()" class="btn btn-warning" type="button">
                    <span class="fas fa-print"></span>
                    Imprimir Ticket
                </button>
            </div>
            <div class="col-sm-2">
            <a  href="{{ route('admin')}}" class="btn btn-danger">
                <span class="fas fa-undo"></span>
               Regresar
            </a>
            </div>
        </div>
    </form>

    <br />
    <br />
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script type="text/javascript" defer>
    let select_tipo_examen = document.getElementById("select-tipo-examen");
    let input_valor_examen = document.getElementById("input-valor-examen");
    let input_total_examen = document.getElementById("input-total-examen");
    
    let tbody_detalles = document.getElementById("tbody-detalles");
    let input_hidden_lista_detalle = document.getElementById("input-lista-detalle");
    let lista_detalles = [];

    $( document ).ready(function() {
        actualizarTablaDetalles();
    });

    function actualizarTablaDetalles(){
        try{
            if ( lista_detalles == null ){
                return;
            }

            input_total_examen.value = 0;
            tbody_detalles.innerHTML = "";

            let aux_subtotales = 0;
            
            //let subtotal = 0;

            lista_detalles.forEach(function(x, index, object) {
                let tr_fila = document.createElement("tr");

                let td_tipo_examen = document.createElement("td");
                td_tipo_examen.append(document.createTextNode(x.tipo_examen));

                let td_valor_examen = document.createElement("td");
                td_valor_examen.append(document.createTextNode("Q. " + x.valor_examen));


                let subtotal = + x.valor_examen;
                aux_subtotales += (subtotal);

                let td_operaciones = document.createElement("td");
                let boton_quitar = document.createElement("button");
                boton_quitar.setAttribute("type", "button");
                boton_quitar.innerHTML = "Quitar";
                boton_quitar.setAttribute("class", "btn btn-danger text-white");
                boton_quitar.addEventListener("click", function(){
                    lista_detalles.splice(index, 1);

                    actualizarTablaDetalles();
                });

                td_operaciones.append(boton_quitar);

                
                tr_fila.append(td_tipo_examen);
                tr_fila.append(td_valor_examen);
                //tr_fila.append(td_observacion);
               
                tr_fila.append(td_operaciones);

                tbody_detalles.append(tr_fila);

               
            });

            input_total_examen.value = aux_subtotales;
            // para mandar una lista de detalles al controlador laravel
            input_hidden_lista_detalle.value = JSON.stringify(lista_detalles);
        }catch(error){
            alert(error);
        }
    }

    function limpiarFormularioDetalle(){
        input_valor_examen.value = null;
       // input_cantidad_comprada.value = null;
       // input_precio_compra.value = null;
    }

    function validarDetallle(){
        if ( select_tipo_examen.value == '' ){
            alert("Debe indicar el tipo de examen.");
            return false;
        }

        if ( input_valor_examen.value == '' ){
            alert("Debe indicar el valor de examen.");
            return false;
        }

       /* if ( input_cantidad_comprada.value == '' ){
            alert("Debe indicar la cantidad comprada.");
            return false;
        }

        if ( input_cantidad_comprada.value <= 0 ){
            alert("La cantidad comprada debe ser mayor a 0.");
            return false;
        }

        if ( input_precio_compra.value == '' ){
            alert("Debe indicar el precio de compra.");
            return false;
        }

        if ( input_precio_compra.value <= 0 ){
            alert("El precio de compra debe ser mayor a 0.");
            return false;
        }*/

        return true;
    }

    function agregarNuevoDetalle(){
        try{
            // validamos que se haya ingresado los campos para el detalle
            if ( !validarDetallle() ){
                return;
            }

            lista_detalles.push({
                'tipo_examen': select_tipo_examen.options[select_tipo_examen.selectedIndex].text,
                'valor_examen': input_valor_examen.value,
                'id_tipo_examen': select_tipo_examen.value,
                
                //'observacion': input_observacion.value,
            });

            
            actualizarTablaDetalles();
            limpiarFormularioDetalle();
        }catch(error){
            alert(error);
        }
    }
</script>
<script>
    function obtenerTextSeleccionadoCombo(id_select){
    if ( id_select == ''){
        return '';
    }

    try {
        return document.getElementById(id_select).options[document.getElementById(id_select).selectedIndex].innerHTML
    }catch(error){
        return '';
    }
}
</script>

<script>
    
function generarTicket(){
   
    
    let tipo_examen = obtenerTextSeleccionadoCombo("select-tipo-examen");
    let nombre_paciente = obtenerTextSeleccionadoCombo("select-paciente");
    let examen_pagado = obtenerTextSeleccionadoCombo("select-examen-pagado");
    try{
    
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
    documento.write("Fecha y tiempo en resultado: " + document.getElementById("input-tiempo_estimado_respuesta").value);
    documento.write('<br>')
   // documento.write("Examen: " + tipo_examen);
   // documento.write('<br>')
    documento.write("Examen pagado: " + examen_pagado);
    documento.write('<br>')
    documento.write("Precio total: Q." + document.getElementById("input-total-examen").value);
    documento.write("</div>");
    documento.write("<p class='centrado'>¡GRACIAS POR SU PREFERENCIA!<br>labcentromedicojireh@yahoo.com </p>")
    documento.write("Fecha en que lo realizo: " + document.getElementById("input-fecha").value);
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
    
</script>
<!--script>
    document.querySelector("#btn1").addEventListener('click', function(){
      Swal.fire("Examen Registrado Correctamente!", "", "success");
    });
</script-->

@stop