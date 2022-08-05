@extends('adminlte::page')

@section('title', 'Ver Examen')

@section('content_header')
    <h1 style="align-content: center">Ver Examen</h1>
@stop

@section('content')
    
<div class="row">
    
    <div class="col-sm-4">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                    <label class="form-label" for="input-no-factura">Fecha:</label></span>
            </div>
        </div>
        
        <input class="form-control"
            type="date"
            name="fecha"
            id="input-fecha"
            placeholder="Fecha"
            @error('fecha') is-invalid @enderror
            value="{{ $examen->fecha }}"
            readonly
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
                <option  disabled value="{{ $paciente->id }}" {{ $paciente->id==$examen->id_paciente ? 'selected':''}}>{{ $paciente->nombre.' '.$paciente->apellido }}</option>
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
            value="{{ $examen->tiempo_estimado_respuesta }}"
            readonly
        />
    </div>

    <!---------------------------------------------------------------------->
</div>
<br>
<div class="row">
    <!--div class="col-sm-4">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                <span class="fas fa-money-check {{ config('adminlte.classes_auth_icon', '') }}">
                    <label class="form-label" for="input-dias-credito">Valor examen:</label></span>
            </div>
        </div>
        
        <input class="form-control"
            type="number"
            name="valor_examen"
            id="input-valor_examen"
            placeholder="Valor examen"
            min="0"
            step="1"
            value="{{ $examen->valor_examen }}"
            readonly
            @error('valor_examen') is-invalid @enderror
        />
        @error('valor_examen')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div-->
    <div class="col-sm-4">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="input-group-addon" style="color:red; font-family: Verdana;">*</span>
                <span class="fas fa-prescription-bottle-alt">
                    <label class="form-label" for="select-examen_pagado">Examen pagado:</label>
                </span>
                
                
            </div>
        </div>
            <select class="form-control @error('examen_pagado') is-invalid @enderror" name="examen_pagado" id="select-examen_pagado">
                <option disabled selected>Seleccione examen pagado</option>
                <option disabled value="0" {{ $examen->examen_pagado == '1' ? 'selected' : '' }}>Si</option>
                <option disabled value="1" {{ $examen->examen_pagado == '2' ? 'selected' : '' }}>No</option>
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
                <option  disabled value="{{ $tecnico->id }}" {{ $tecnico->id==$examen->id_tecnico? 'selected':''}}>{{ $tecnico->nombre }}</option>
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
            value="{{ $examen->motivo }}"
            readonly
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
                <option  disabled value="{{ $medico->id }}" {{ $medico->id==$examen->id_medico_referente ? 'selected':''}}>{{ $medico->nombre }}</option>
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
            value="{{ $examen->adjunto_orden }}"
            readonly
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
            value="{{ $examen->documento_resultado }}"
            readonly
        />
    </div>
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
                @foreach($tipo_examen as $tipo_examenes)
                <option  disabled value="{{ $tipo_examenes->id }}" {{ $tipo_examenes->id==$examen->id_tipo_examen ? 'selected':''}}>{{ $tipo_examenes->nombre }}</option>
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
            value="{{ $examen->valor_examen }}"
        />
        @error('total_examen')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

        <br>
        <br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Tipo de Examen</th>
                <th>Valor de examen</th>
                
            </tr>
        </thead>
        <tbody id="tbody-detalles">
            @foreach ($detalleExamen as $detalle)
            <tr>
                <td>{{$detalle->tipo_examen ?
                    $detalle->tipo_examen->nombre:""}}</td>
                <td>{{$detalle->valor_examen}}</td>
                
                 
            </tr>
            @endforeach
        </tbody>
    </table>
    <br />
    <br />
    <input hidden type="text" name="lista_detalle" id="input-lista-detalle">
    <br />
        <br />
        <div class="row">
            <div class="col-sm-4">
                <a  href="javascript: history.go(-1)" class="btn btn-primary">
                    <span class="fas fa-undo"></span>
                   Regresar a Examenes
                </a>
                </div>
           
            <div class="col-sm-4">
            <a  href="{{ route('admin')}}" class="btn btn-danger">
                <span class="fas fa-home"></span>
               Dashboard
            </a>
            </div>
        </div>
 

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop