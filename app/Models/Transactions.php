<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

     protected $fillable = [
        'from_account_id',
        'to_account_id',
        'amount',
        'status',
    ];

    public function fromAccount()
    {
        return $this->belongsTo(ClientAccount::class, 'from_account_id');
    }

    public function toAccount()
    {
        return $this->belongsTo(ClientAccount::class, 'to_account_id');
    }
}
