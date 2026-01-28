<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterventionNotification extends Model
{
    protected $table = 'intervention_notifications';
    protected $primaryKey = 'notification_id';
    protected $fillable = [
        'notification_id',
        'player_id',
        'representative_id',
        'reason',
        'total_errors_detected',
        'distinct_lessons_failed',
        'is_read'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
