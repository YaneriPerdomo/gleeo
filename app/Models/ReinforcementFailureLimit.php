<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReinforcementFailureLimit extends Model
{
    protected $table = 'reinforcement_failure_limit';

    protected $primaryKey = 'reinforcement_failure_limit_id';

    protected $fillable = [
        'reinforcement_failure_limit_id',
        'refuerzo_fail_limit',
        'is_active'
    ];

}
