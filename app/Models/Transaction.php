<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $fillable = [
        'ticket_id',
        'user_id',
        'name',
        'email',
        'no_telp',
        'amount',
        'total',
        'snap_token',
        'confirmed',
    ];

    public function fk_user_id()
    {
        /* Get all data from user */
        return $this->belongsTo(User::class,'user_id');
    }
    public function fk_ticket_id()
    {
        /* Get all data from user */
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
