<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'account_number',
        'account_type',
        'balance',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

 
}
