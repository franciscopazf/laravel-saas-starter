<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class SimpleUser extends Model
{
    //
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'global_id',
        'workos_id',
        'avatar',
    ];
}
