<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $table = 'representatives';

    protected $primaryKey = 'representative_id';

    protected $fillable = [
        'representative_id',
        'gender_id',
        'user_id',
        'names',
        'surnames',
        'slug',
        'created_at',
        'type',
        'country_id',
        'educational_center',
    ];

    const UPDATED_AT = null;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public $timestamps = true;
}
