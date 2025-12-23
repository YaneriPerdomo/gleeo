<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
class DecisionPattern extends Model
{
    protected $table = "decision_pattern";
    protected $primaryKey = "decision_pattern_id";
    protected $fillable = [
        "decision_pattern_id",
        "name",
        "description",
        "is_active",
    ];
    public $timestamps = false;
    public function alertThreshold(): hasOne
    {
        return $this->hasOne(AlertThreshold::class, 'decision_pattern_id');
    }
}
