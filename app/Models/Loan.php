<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\LoanProduct;
use App\Models\Payment;
use App\Models\Guarantors;
use App\Models\PaymentSchedule;
use Illuminate\Support\Carbon;

class Loan extends Model
{
    protected $fillable = ['loan_number', 'loan_product_id', 'client_id', 'amount', 'interest_rate','payment_frequency', 'status', 'start_date', 'end_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function guarantors()
    {
        return $this->hasMany(Guarantors::class);
    }

    public function paymentSchedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $loan->loan_number = $loan->generateLoanNumber();
        });

        static::created(function ($loan) {
            $loan->generatePaymentSchedules();
        });
    }

    private function generateLoanNumber()
    {
        $latestLoan = Loan::latest('id')->first();
        $nextNumber = $latestLoan ? ((int)substr($latestLoan->loan_number, 2)) + 1 : 1;
        return 'LN' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function generatePaymentSchedules()
    {
    $principal = $this->amount;
    $annualInterestRate = $this->interest_rate;
    $termInMonths = $this->loanProduct->term;
    $paymentFrequency = $this->payment_frequency; // 'weekly', 'bi-weekly', 'monthly'

    // Get the number of payment intervals per year based on the frequency
    $paymentIntervalsPerYear = $this->getPaymentIntervals($paymentFrequency);

    // Total number of payments for the loan duration
    $numberOfPayments = ceil(($termInMonths / 12) * $paymentIntervalsPerYear);

    // Calculate the interest rate per interval
    $intervalInterestRate = ($annualInterestRate / 100) / $paymentIntervalsPerYear;

    // Calculate payment amount based on the frequency
    $paymentAmount = $intervalInterestRate > 0
        ? ($principal * $intervalInterestRate * pow(1 + $intervalInterestRate, $numberOfPayments)) / (pow(1 + $intervalInterestRate, $numberOfPayments) - 1)
        : $principal / $numberOfPayments;

    $paymentAmount = round($paymentAmount, 2);

    $paymentSchedules = [];
    $balance = $principal;
    $currentDate = Carbon::parse($this->start_date);

    for ($i = 1; $i <= $numberOfPayments; $i++) {
        $interest = round($balance * $intervalInterestRate, 2);
        $principalAmount = round($paymentAmount - $interest, 2);

        // Adjust for rounding errors on the last installment
        if ($i == $numberOfPayments) {
            $principalAmount = $balance;
            $paymentAmount = $principalAmount + $interest;
        }

        // Calculate due date based on payment frequency
        $dueDate = $this->calculateDueDate($currentDate, $i, $paymentFrequency);

        $paymentSchedules[] = [
            'loan_id'          => $this->id,
            'due_date'         => $dueDate->toDateString(),
            'principal_amount' => $principalAmount,
            'interest_amount'  => $interest,
            'total_amount'     => $paymentAmount,
            'is_paid'          => false,
            'created_at'       => now(),
            'updated_at'       => now(),
        ];

        $balance -= $principalAmount;
    }

    PaymentSchedule::insert($paymentSchedules);
}

    private function getPaymentIntervals($frequency)
    {
        switch ($frequency) {
            case 'weekly':
                return 52; // 52 weeks in a year
            case 'bi-weekly':
                return 26; // 26 bi-weekly periods in a year
            case 'monthly':
                return 12; // 12 months in a year
            default:
                return 12; // Default to monthly if not specified
        }
    }

    private function calculateDueDate($currentDate, $paymentNumber, $frequency)
    {
        switch ($frequency) {
            case 'weekly':
                return $currentDate->copy()->addWeeks($paymentNumber);
            case 'bi-weekly':
                return $currentDate->copy()->addWeeks($paymentNumber * 2);
            case 'monthly':
                return $currentDate->copy()->addMonths($paymentNumber);
            default:
                return $currentDate->copy()->addMonths($paymentNumber);
        }
    }

}
