<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeOption extends Model
{
    protected $table = 'practice_options';

    protected $primaryKey = 'practice_option_id';

    protected $fillable = [
        'variables',
        'correct_variable',
    ];

        public $timestamps = false;

}
