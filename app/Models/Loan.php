<?php
// app/Models/Loan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $primaryKey = 'LoanID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'BorrowerID',
        'LoanAmount',
        'InterestRate',
        'LoanTerm',
        'StartDate',
        'EndDate',
        'PaymentType'
    ];

    public function schedules()
    {
        return $this->hasMany(LoanSchedule::class, 'LoanID');
    }
}
