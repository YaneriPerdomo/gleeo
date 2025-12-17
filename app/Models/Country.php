<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $primaryKey = 'country_id';
    protected $fillable = [
        'country_id',
        'country',

    ];
    const UPDATED_AT = null;
    public $timestamps = false;
}
