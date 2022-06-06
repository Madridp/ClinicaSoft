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
            'password' => 'required|confirmed'
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
            'name' => 'required|unique:users',
            'email' => 'required|unique:users'
            
        ]);
        
            $usuario= User::whereId($id)->update($validatedData);

        //si se edito el usuario
        return redirect('/usuario/index')->with('Listo', 'Usuario editado correctamente');
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
            return redirect('/usuario/index')->with('No se puede eliminar el usuario');
        }else{
        $user->estado = 0; // eliminado
        $user->update();
        }
        return redirect('/usuario/index')->with('Listo', 'Usuario eliminado correctamente');
    }
}
