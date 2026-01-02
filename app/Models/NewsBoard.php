<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsBoard extends Model
{
    protected $table = "news_board";
    protected $primaryKey = "news_board_id";
    protected $fillable = [
        "subject",
        "description",
        "year_start",
        "year_end",
    ];
    public $timestamps = false;
}
