<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\MedicoReferente;
use App\Models\Paciente;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); // el usuario debe estar autenticado
    }

    public function index(){
        $users = User::where('estado', '=', 1)->count();
        $paciente = Paciente::where('estado', '=', 1)->count();
        $tecnico = Tecnico::where('estado', '=', 1)->count();
        $medico = MedicoReferente::where('estado', '=', 1)->count();
        $ex = Examen::where('estado', '=', 1)->count();

        function devolverDiaSemanaExiste($arreglo, $diaSemana)
        {

            foreach($arreglo as $dia)
            {
                if ( $dia['diaSemana'] == $diaSemana ){
                    return $dia['count'];
                }
            }

            return 0;
        }


        $examenes = Examen::where('estado', '=', 1)->latest()->take(5)->get();

        $e = Examen::where('fecha', '>=', Carbon::now()->startOfWeek())
             ->where('fecha', '<=', Carbon::now()->endOfWeek())
             ->where('estado', '=', 1)
             ->select(DB::raw('DAYOFWEEK(fecha) as diaSemana, count(*) as count'))
             ->groupBy(DB::raw('diaSemana'))
             ->get();

            // return response()->json($e);
             $totalExamenes = array();

                $totalExamenes[] = devolverDiaSemanaExiste($e, 2); //lunes
                $totalExamenes[] = devolverDiaSemanaExiste($e, 3); //martes
                $totalExamenes[] = devolverDiaSemanaExiste($e, 4); //miercoles
                $totalExamenes[] = devolverDiaSemanaExiste($e, 5); //jueves
                $totalExamenes[] = devolverDiaSemanaExiste($e, 6); //viernes
                $totalExamenes[] = devolverDiaSemanaExiste($e, 7); //sabado
                $totalExamenes[] = devolverDiaSemanaExiste($e, 1); //domingo

              //  return response()->json($totalExamenes);

       return view('admin.index', [
            //  'roles' => $roles,
              'users' => $users,
              'paciente' => $paciente,
              'tecnico' => $tecnico,
              'medico' => $medico,
              'examenes' => $examenes,
              'ex' => $ex,
              'e' => $totalExamenes,
          ]);
    }
}
