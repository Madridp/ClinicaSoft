@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!--h1>Lab Clinico Jireh</h1-->
@stop

@section('content')
    <section class="py-7" >
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                   
                    <h2 class="font-weigth-bold mb-0">Bienvenido {{ auth()->user()->name }}</h2>
                    <p class="lead text-muted">Revisa la última información</p>
                </div>
                <!--div class="col-lg-3 d-flex">
                    @if ( Auth::user()->id_rol == 1)
                    <button class="btn btn-primary w-100 align-self-center">Descargar reporte</button>
                    @endif
                </div-->
            </div>
        </div>    
    </section>
    <section>
        <div class="container">
            <div class="card rounded-0 py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 my-3" style="border-right: 1px solid var(--grey);">
                            <div class="mx-auto">
                            <h4 class="text-muted"><i class="fas fa-user-tie"> Usuarios</h4></i>
                            <h3 class="font-weight-bold">{{ $users }}</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 my-3" style="border-right: 1px solid var(--grey);">
                            <div class="mx-auto">
                            <h4 class="text-muted"><i class="fas fa-user-alt"> Pacientes</i></h4>
                            <h3 class="font-weight-bold">{{ $paciente }}</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 my-3" style="border-right: 1px solid var(--grey);">
                            <div class="mx-auto">
                            <h4 class="text-muted"><i class="fas fa-id-card"> Técnicos</i></h4>
                            <h3 class="font-weight-bold">{{ $tecnico }}</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 my-3" style="border-right: 1px solid var(--grey);">
                            <div class="mx-auto">
                            <h4 class="text-muted"><i class="fas fa-user-md"> Médicos Referentes</i></h4>
                            <h3 class="font-weight-bold">{{ $medico }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 my-3">
                    <div class="card rounded-0">
                        <div class="card-header bg-secondary">
                            <h6 class="font-weight-bold text-white">Exámenes realizados en cada día de la semana</h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="card rounded-0">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-bold mb-0">Exámenes recientes</h6>
                        </div>
                        <div class="card-body pt-2">
                            @foreach ($examenes as $examen)
                            <div class="d-flex border-bottom py-2">
                                <div class="d-flex mr-3">
                                    <h2 class="align-self-center mb-0"><i class="fas fa-user"></i></h2>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="d-inline-block mb-0">{{$examen->paciente ?
                                        $examen->paciente->nombre.' '.$examen->paciente->apellido:""}}</h6><span class="badge badge-success ml-2">{{$examen->tipo_examen ?
                    $examen->tipo_examen->nombre:""}}</span>
                                    <small class="d-block text-muted">Q.{{$examen->valor_examen}}</small>
                                </div>
                            </div>
                           
                            @endforeach
                            <a href="{{ route('examen.bitacora')}}" class="btn btn-primary w-100">Ver todos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
    <script>
        Swal.fire(
            '¡Bienvenido!',
            '{{ auth()->user()->name }}',
            'success'
        )
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" 
    integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>

    <script>
        const labels = [
          'Lunes',
          'Martes',
          'Miércoles',
          'Jueves',
          'Viernes',
          'Sábado',
          'Domingo',
        ];
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'Exámenes en la última semana',
            backgroundColor: [
                'rgb(91, 192, 222)',
                'rgb(173, 255, 47)',
                'rgb(255, 160, 122)',
                'rgb(32, 178, 170)',
                'rgb(0, 250, 154)',
                'rgb(65, 105, 225)',
                'rgb(2, 117, 216)',
            ],
            borderColor: [
                'rgb(91, 192, 222)',
                'rgb(173, 255, 47)',
                'rgb(255, 160, 122)',
                'rgb(32, 178, 170)',
                'rgb(0, 250, 154)',
                'rgb(65, 105, 225)',
                'rgb(2, 117, 216)',
            ],
            data:["{{ $e[0] }}",
                "{{ $e[1] }}",
                "{{ $e[2] }}",
                "{{ $e[3] }}",
                "{{ $e[4] }}",
                "{{ $e[5] }}",
                "{{ $e[6] }}",
                ],
          }]
        };
      
        const config = {
          type: 'bar',
          data: data,
          options: {}
        };
      </script>
      <script>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script>
@stop
