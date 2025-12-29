<?php

namespace App\Models;

use App\Models\Theme as ModelsTheme;
use Illuminate\Database\Eloquent\Model;
use Psy\Output\Theme;

class Player extends Model
{
    protected $table = 'players';
    protected $primaryKey = 'player_id';
    protected $fillable = [
        'player_id',
        'gender_id',
        'avatar_id',
        'user_id',
        'names',
        'surnames',
        'date_of_birth',
        'theme_id',
        'reading_mode',
        'slug',
        'representative_id',
        'level_assigned_id',
        'validated'
    ];

    public function level_assigned()
    {
        //class - llave foranea - llave primera;
       return $this->belongsTo(Level::class, 'level_assigned_id', 'level_id');
    }

    public function gender()
    {
        return $this->hasOne(Gender::class, 'gender_id');
    }
    public function representative()
    {
        return $this->hasOne(Representative::class, 'representative_id');
    }

    public function theme()
    {
        return $this->hasOne(ModelsTheme::class, 'theme_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function avatar()
    {
        return $this->hasOne(Avatar::class, 'avatar_id');
    }
}
