<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'no_telp',
        'amount',
        'total',
        'confirmed',
    ];

    public function fk_user_id()
    {
        /* Get all data from user */
        return $this->belongsTo(User::class,'id');
    }
}
