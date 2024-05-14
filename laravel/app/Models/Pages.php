<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'place',
        'start_date',
        'end_date',
        'description',
        'location',
        'video',
    ];
}