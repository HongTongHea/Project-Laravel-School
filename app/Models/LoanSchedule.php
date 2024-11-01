<?php

// app/Models/LoanSchedule.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    protected $fillable = [
        'LoanID',
        'PaymentDate',
        'PaymentAmount',
        'PrincipalPaid',
        'InterestPaid',
        'Balance'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'LoanID');
    }
}
