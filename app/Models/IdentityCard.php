<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityCard extends Model
{
    
    protected $table = 'identity_cards';
    protected $primaryKey = 'identity_card_id';
    protected $fillable = [
        'identity_card',
        'letter'
    ];
}
