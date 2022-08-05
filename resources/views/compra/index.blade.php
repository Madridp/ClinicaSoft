@extends('adminlte::page')

@section('title', 'Realizar compras')

@section('content_header')
    <h1 style="align-content: center">Formulario Compras</h1>
@stop

@section('content')
    <form action="{{ route('compra.store') }}" method="post">
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
                        <span class="fas fa-money-check-alt">
                            <label class="form-label" for="select-tipo-compra">Seleccione tipo compra:</label>
                        </span>
                        
                        
                    </div>
                </div>
                    <select class="form-control @error('id_tipo_compra') is-invalid @enderror" name="id_tipo_compra" id="select-tipo-compra">
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
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                       
                        <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-no-factura">No. factura: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="number"
                    name="no_factura"
                    id="input-no-factura"
                    placeholder="No. fatura"
                />
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-dias-credito">Días crédito: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="number"
                    name="dias_credito"
                    id="input-dias-credito"
                    placeholder="Días de credito"
                    min="0"
                    step="1"
                />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-calendar-check">
                            <label class="form-label" for="input-fecha-compra">Fecha compra:</label>
                        </span>
                    </div>
                </div>
                <input class="form-control @error('fecha_compra') is-invalid @enderror"
                    type="date"
                    name="fecha_compra"
                    id="input-fecha-compra"
                    
                />

                @error('fecha_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="far fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-fecha-recibe">Fecha recibe:</label></span>     
                    </div>
                </div>
                
                <input class="form-control"
                    type="date"
                    name="fecha_recibe"
                    id="input-fecha-recibe"
                />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="far fa-handshake {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="select-proveedor">Seleccione proveedor:</label></span>
                    </div>
                </div>
                
                <select class="form-control @error('id_proveedor') is-invalid @enderror" name="id_proveedor" id="select-proveedor">
                    <option disabled selected>Seleccione un proveedor</option>
                    @foreach($proveedor as $provedor)
                    <option value="{{ $provedor->id }}">{{ $provedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-money-bill {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-total-compra">Total compra:</label></span>
                    </div>
                </div>
                
                <input class="form-control @error('total_compra') is-invalid @enderror"
                    type="number"
                    name="total_compra"
                    id="input-total-compra"
                    placeholder="Total compra"
                    readonly
                />
                @error('total_compra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <br />
        <h3>Detalle Compra</h3>
        <br />
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        
                        <span class="fas fa-calendar-times {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="input-fecha-vencimiento">Fecha vencimiento: (si aplica)</label></span>
                    </div>
                </div>
                
                <input class="form-control"
                    type="date"
                    id="input-fecha-vencimiento"
                    name="fecha_vencimiento"
                />
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-prescription-bottle-alt {{ config('adminlte.classes_auth_icon', '') }}">
                        <label class="form-label" for="select-insumo">Seleccione insumo:</label></span>
                    </div>
                </div>
                
               <select class="form-control @error('id_insumo')  is-invalid @enderror"  name="id_insumo" id="select-insumo">
                    <option disabled selected>Seleccione un tipo de insumo</option>
                    @foreach($insumos as $insumo)
                    <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                    @endforeach
                </select>

            @error('id_insumo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-clipboard-list {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-no-lote">No. lote:</label></span>
                    </div>
                </div>
                
                <input class="form-control @error('no_lote') is-invalid @enderror"
                    type="number"
                    id="input-no-lote"
                    nombre="no_lote"
                    placeholder="No. Lote"
                    min="0"
                    step="1"
                />
                @error('no_lote')
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
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-boxes {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-cantidad-comprada">Cantidad compra:</label></span>
                    </div>
                </div>
               
                <input class="form-control @error('cantidad') is-invalid @enderror"
                    type="number"
                    id="input-cantidad-comprada"
                    name="cantidad"
                    placeholder="Cantidad comprada"
                    min="1"
                    step="1"
                />
                @error('cantidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                        <span class="fas fa-shopping-basket {{ config('adminlte.classes_auth_icon', '') }}">
                            <label class="form-label" for="input-precio-compra">Precio compra:</label></span>
                    </div>
                </div>
                
                <input class="form-control @error('precio_compra') is-invalid @enderror"
                    type="number"
                    id="input-precio-compra"
                    name="precio_compra"
                    placeholder="Precio de compra"
                    min="1"
                    step="1"
                />
                @error('precio_compra')
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
        <br />
        <br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Fecha vencimiento</th>
                <th>Insumo</th>
                <th>No. Lote</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
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
            <div class="col-sm-4">
                <button id="btn2" class="btn btn-primary" type="submit">
                    <span class="fas fa-first-aid"></span>
                    Registrar compra
                </button> 
            </div>
            <div class="col-sm-4">
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
    let input_total_compra = document.getElementById("input-total-compra");
    let input_fecha_vencimiento = document.getElementById("input-fecha-vencimiento");
    let select_insumo = document.getElementById("select-insumo");
    let input_no_lote = document.getElementById("input-no-lote");
    let input_cantidad_comprada = document.getElementById("input-cantidad-comprada");
    let input_precio_compra = document.getElementById("input-precio-compra");
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

            input_total_compra.value = 0;
            tbody_detalles.innerHTML = "";

            let aux_subtotales = 0;

            lista_detalles.forEach(function(x, index, object) {
                let tr_fila = document.createElement("tr");

                let td_fecha_vencimiento = document.createElement("td");
                td_fecha_vencimiento.append(document.createTextNode(x.fecha_vencimiento));

                let td_insumo = document.createElement("td");
                td_insumo.append(document.createTextNode(x.insumo_nombre));

                let td_no_lote = document.createElement("td");
                td_no_lote.append(document.createTextNode(x.no_lote));

                let td_cantidad = document.createElement("td");
                td_cantidad.append(document.createTextNode(x.cantidad));

                let td_precio = document.createElement("td");
                td_precio.append(document.createTextNode("Q. " + x.precio_compra));

                let subtotal = x.precio_compra * x.cantidad;
                let td_subtotal = document.createElement("td");
                td_subtotal.append(document.createTextNode("Q. " + subtotal));

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

                tr_fila.append(td_fecha_vencimiento);
                tr_fila.append(td_insumo);
                tr_fila.append(td_no_lote);
                tr_fila.append(td_cantidad);
                tr_fila.append(td_precio);
                tr_fila.append(td_subtotal);
                tr_fila.append(td_operaciones);

                tbody_detalles.append(tr_fila);
            });

            input_total_compra.value = aux_subtotales;
            // para mandar una lista de detalles al controlador laravel
            input_hidden_lista_detalle.value = JSON.stringify(lista_detalles);
        }catch(error){
            alert(error);
        }
    }

    function limpiarFormularioDetalle(){
        input_no_lote.value = null;
        input_cantidad_comprada.value = null;
        input_precio_compra.value = null;
    }

    function validarDetallle(){
        if ( select_insumo.value == '' ){
            alert("Debe indicar el insumo.");
            return false;
        }

        if ( input_no_lote.value == '' ){
            alert("Debe indicar el número de lote.");
            return false;
        }

        if ( input_cantidad_comprada.value == '' ){
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
        }

        return true;
    }

    function agregarNuevoDetalle(){
        try{
            // validamos que se haya ingresado los campos para el detalle
            if ( !validarDetallle() ){
                return;
            }

            lista_detalles.push({
                "fecha_vencimiento": input_fecha_vencimiento.value,
                'insumo_nombre': select_insumo.options[select_insumo.selectedIndex].text,
                'insumo_id': select_insumo.value,
                'no_lote': input_no_lote.value,
                'cantidad': input_cantidad_comprada.value,
                'precio_compra': input_precio_compra.value,
            });

            actualizarTablaDetalles();
            limpiarFormularioDetalle();
        }catch(error){
            alert(error);
        }
    }
</script>
<!--script>
    document.querySelector("#btn2").addEventListener('click', function(){
      Swal.fire("Compra Registrada Correctamente!", "", "success");
    });
    </script-->
@stop