<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'interest_rate', 'max_amount', 'term'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
