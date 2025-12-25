<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class practiceOption extends Model
{
    protected $table = 'practice_options';

    protected $primaryKey = 'practice_option_id';

    protected $fillable = [
        'variables',
        'correct_variable',
    ];
}
