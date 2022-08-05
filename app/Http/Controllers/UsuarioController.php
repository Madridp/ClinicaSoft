<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
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
    public function index()
    {
         
         //$sql = 'SELECT * FROM users';
      //  $users = DB::select($sql);
      $users = User::where('estado', '=', 1)->get();
      //$users = User::all();
     // $roles = Rol::all();
      return view('usuario.index', [
        //  'roles' => $roles,
          'users' => $users
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if ( Auth::user()->id_rol != 1 ){ // si el usuarsio autenticado no es administrador, bloquear acceso
            return redirect()->route('admin');
        }
        $roles = Rol::all();

        return view('usuario.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User::create($request->all());

        $this->validate($request,[
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
        
            $usuario=User::create($request->merge([
                'password'=>Hash::make($request['password'])])->all());

        //si se registro el usuario
        if($usuario){
            return redirect()->route('admin');}else{
                return redirect()->back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        
        $user = User::findOrFail($id);
        $roles = Rol::all();
        //$users = User::where('estado', '=', 1)->get();
        
        return view('usuario.edit',  [
            'roles' => $roles,
            'user' => $user
          ]);
         // dd('aca LLEGA JEJE');
         
          
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'id_rol' => 'required',
            'password' => 'nullable|confirmed|min:6'
        ]);
        
        $usuario = User::find($id);
        $usuario->name = $request->get('name');
        $usuario->email= $request->get('email');
        $usuario->id_rol = $request->get('id_rol');
        if ( $request->get('password') != '' ) {
        $usuario->password = Hash::make($request->get('password'));
        }
        $usuario->update();

        //si se edito el usuario
        return redirect('/usuario')->with('Listo', 'Usuario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $id_au = Auth::id();
        if($user->id==$id_au){
            return redirect('/usuario')->with('No se puede eliminar el usuario');
        }else{
        $user->estado = 0; // eliminado
        $user->update();
        }
        return redirect('/usuario')->with('Listo', 'Usuario eliminado correctamente');
    }
}
