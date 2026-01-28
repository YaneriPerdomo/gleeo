<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertConfiguration extends Model
{
    protected $table = 'alert_configurations';
    protected $primaryKey = 'alert_config_id';
    protected $fillable = [
        'alert_config_id',
        'level_id',
        'max_errors_allowed',
        'time_frame',
        'state'
    ];

    public function level()
    {
        return $this->hasOne(Level::class, 'level_id');
    }
}
