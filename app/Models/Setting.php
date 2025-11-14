<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site',
        'name',
        'archive_name',
        'archive',
        'companie_name',
        'companie_description',
    ];
}
