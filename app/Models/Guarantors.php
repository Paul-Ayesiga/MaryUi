<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantors extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'client_id', 'relationship'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
