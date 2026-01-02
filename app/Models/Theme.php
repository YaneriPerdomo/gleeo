<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';
    protected $primaryKey = 'theme_id';
    protected $fillable = [
        'theme_id',
        'name',
        'main_color',
        'secondary_color',
        'background_path',
        'border_radius',
        'for_sale',
        'solid_background',
        'slug',
        'topic_color'
    ];
}
