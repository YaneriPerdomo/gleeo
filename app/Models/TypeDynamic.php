<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeDynamic extends Model
{
    protected $table = 'types_dynamics';

    protected $primaryKey = 'type_dynamic_id';

    protected $fillable = [
        'type',
    ];
}
