<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public function rol()
    {
        return $this->hasOne(Rol::class,'id', 'id_rol');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'estado', 'id_rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_image(){

        if (Auth::user()->id_rol == 2) {
            return '/img/avatarm.jpg';
        }elseif(Auth::user()->id_rol == 3){
            return '/img/avatarp.png';
        }
        return '/img/avatar.jpg';
       // return 'resources/img/usuario.jpg';
    }

    public function adminlte_desc(){
        if (Auth::user()->id_rol == 2) {
            return "Secretario";
        }elseif(Auth::user()->id_rol == 3){
            return "Técnico";
        }
        return "Administrador";
    }

    public function adminlte_profile_url(){
        return 'user/profile';
    }
}
