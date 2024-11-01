<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanSchedule;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'BorrowerID' => 'required',
            'LoanAmount' => 'required|numeric',
            'InterestRate' => 'required|numeric',
            'LoanTerm' => 'required|integer',
            'StartDate' => 'required|date',
            'EndDate' => 'nullable|date',
            'PaymentType' => 'required|string|max:50',
        ]);

        $loan = Loan::create($validated);

        $this->generateLoanSchedule($loan);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully with payment schedule.');
    }

    private function generateLoanSchedule(Loan $loan)
    {
        $loanAmount = $loan->LoanAmount;
        $annualInterestRate = $loan->InterestRate / 100;
        $loanTerm = $loan->LoanTerm;
        $balance = $loanAmount;
        $paymentDate = $loan->StartDate;

   
        switch ($loan->PaymentType) {
            case 'Monthly Installments':
                $periods = $loanTerm;
                $paymentInterval = '+1 month';
                $monthlyInterestRate = $annualInterestRate / 12;
                break;

            case 'Bi-Weekly Installments':
                $periods = $loanTerm * 2;
                $paymentInterval = '+2 weeks';
                $monthlyInterestRate = $annualInterestRate / 26;
                break;

            case 'Weekly Installments':
                $periods = $loanTerm * 4;
                $paymentInterval = '+1 week';
                $monthlyInterestRate = $annualInterestRate / 52;
                break;

            case 'One-Time Payment':
                $periods = 1;
                $paymentInterval = '+1 month';
                $monthlyInterestRate = 0; 
                break;

            default:
                throw new \Exception("Invalid Payment Type");
        }


        if ($loan->PaymentType !== 'One-Time Payment') {
            $paymentAmount = $loanAmount * $monthlyInterestRate / (1 - pow((1 + $monthlyInterestRate), -$periods));
        } else {
            $paymentAmount = $loanAmount * (1 + $annualInterestRate);
        }

 
        for ($i = 1; $i <= $periods; $i++) {
            $interestPaid = $balance * $monthlyInterestRate;
            $principalPaid = $paymentAmount - $interestPaid;
            $balance -= $principalPaid;

            LoanSchedule::create([
                'LoanID' => $loan->LoanID,
                'PaymentDate' => $paymentDate,
                'PaymentAmount' => $paymentAmount,
                'PrincipalPaid' => $principalPaid,
                'InterestPaid' => $interestPaid,
                'Balance' => $balance
            ]);

            $paymentDate = date('Y-m-d', strtotime($paymentInterval, strtotime($paymentDate)));
        }
    }



    public function show($id)
    {
        $loan = Loan::with('schedules')->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'BorrowerID' => 'required',
            'LoanAmount' => 'required|numeric',
            'InterestRate' => 'required|numeric',
            'LoanTerm' => 'required|integer',
            'StartDate' => 'required|date',
            'EndDate' => 'nullable|date',
            'PaymentType' => 'required|string|max:50',
        ]);


        $loan->update($validated);


        $loan->schedules()->delete();

        $this->generateLoanSchedule($loan);

        return redirect()->route('loans.index')->with('success', 'Loan and schedule updated successfully.');
    }


    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}
