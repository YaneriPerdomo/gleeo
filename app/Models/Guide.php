<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $table = 'guides';
    protected $primaryKey = 'guide_id';
    protected $fillable = [
        'title',
        'paragraph'
    ];
}
