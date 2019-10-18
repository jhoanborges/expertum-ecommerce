<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;



    //protected $table = 'usersclientes'; 
    protected $table = 'users'; 
   /*
    protected $fillable = [
        'name', 'email', 'password','nombres','apellidos','numeroidentificacion','telefono','id_perfil','confirmacion','codigo_confirmacion' ,'username', 'status', 'activation_code',
    ];
*/
     protected $guarded = ['id'];
 protected $fillable = [];
    protected $hidden = [
        'password', 'remember_token',
    ];




}
