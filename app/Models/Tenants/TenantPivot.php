<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Model;

class TenantPivot extends Model
{
    //

    protected $table = 'tenant_users';


    protected $fillable = [
        'tenant_id',
        'global_user_id',
    ];


    protected $casts = [
        'tenant_id' => 'string',
        'global_user_id' => 'string',
    ];
}
