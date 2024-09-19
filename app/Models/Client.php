<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'date_of_birth'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function guarantorFor()
    {
        return $this->hasMany(Guarantors::class);
    }

    public function accounts()
    {
        return $this->hasMany(ClientAccount::class);
    }
}
