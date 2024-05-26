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
        'ticket_id',
        'name',
        'email',
        'no_telp',
        'amount',
        'total',
        'code',
        'confirmed',
    ];

    public function fk_user_id()
    {
        /* Get all data from user */
        return $this->belongsTo(User::class,'id');
    }
    public function fk_ticket_id()
    {
        /* Get all data from user */
        return $this->belongsTo(Ticket::class,'id');
    }
}
