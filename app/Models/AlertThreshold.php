<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AlertThreshold extends Model
{
    protected $table = 'alert_threshold';
    protected $primaryKey = 'alert_threshold_id';
    protected $fillable = [
        'alert_threshold_id',
        'decision_pattern_id',
        'refuerzo_fail_limit',
        'alert_ce_activations',
        'time_window',
        'alert_recipient',
    ];
    public $timestamps = false;
    public function decision_pattern()
    {
        return $this->belongsTo(DecisionPattern::class, 'decision_pattern_id');
    }
}
