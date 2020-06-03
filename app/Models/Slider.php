<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title_text','title_size','title_color','link'];
    public $timestamps = false;
}
