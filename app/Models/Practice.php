<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $table = 'practices';

    protected $primaryKey = 'practice_id';

    protected $fillable = [
        'lesson_id',
        'reinforcement_id',
        'practice_option_id',
        'type_dynamic_id',
        'screen',
        'practice_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    public function reinforcement()
    {
        return $this->belongsTo(Reinforcement::class, 'reinforcement_id');
    }
    public function practiceOption()
    {
        return $this->belongsTo(practiceOption::class, 'practice_option_id');
    }
    public function typeDynamic()
    {
        return $this->belongsTo(TypeDynamic::class, 'type_dynamic_id');
    }

    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id');
    }
}
