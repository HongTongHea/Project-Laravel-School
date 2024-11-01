@extends('layouts.app')

@section('title', 'Create New Loan')

@section('app-content')
<div class="card">
    <div class="card-body">
        <h1>Create New Loan</h1>

        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
    
            <div class="form-group">
                <label for="BorrowerID">Borrower ID</label>
                <input type="number" name="BorrowerID" id="BorrowerID" class="form-control" value="{{ old('BorrowerID') }}"
                    required>
            </div>
    
            <div class="form-group">
                <label for="LoanAmount">Loan Amount</label>
                <input type="number" name="LoanAmount" id="LoanAmount" class="form-control" value="{{ old('LoanAmount') }}"
                    step="0.01" required>
            </div>
    
            <div class="form-group">
                <label for="InterestRate">Interest Rate</label>
                <input type="number" name="InterestRate" id="InterestRate" class="form-control"
                    value="{{ old('InterestRate') }}" step="0.01" required>
            </div>
    
            <div class="form-group">
                <label for="LoanTerm">Loan Term (Months)</label>
                <input type="number" name="LoanTerm" id="LoanTerm" class="form-control" value="{{ old('LoanTerm') }}"
                    required>
            </div>
    
            <div class="form-group">
                <label for="StartDate">Start Date</label>
                <input type="date" name="StartDate" id="StartDate" class="form-control" value="{{ old('StartDate') }}"
                    required>
            </div>
    
            <div class="form-group">
                <label for="EndDate">End Date</label>
                <input type="date" name="EndDate" id="EndDate" class="form-control" value="{{ old('EndDate') }}">
            </div>
    
            {{-- <div class="form-group">
                <label for="PaymentType">Payment Type</label>
                <input type="text" name="PaymentType" id="PaymentType" class="form-control" value="{{ old('PaymentType') }}"
                    required>
            </div> --}}
            <div class="form-group">
                <label for="PaymentType">Payment Type</label>
                <select name="PaymentType" id="PaymentType" class="form-control" required>
                    <option value="">Select Payment Type</option>
                    <option value="Monthly Installments">Monthly Installments</option>
                    <option value="Bi-Weekly Installments">Bi-Weekly Installments</option>
                    <option value="Weekly Installments">Weekly Installments</option>
                    <option value="One-Time Payment">One-Time Payment</option>
                </select>
            </div>
            
    
            <button type="submit" class="btn btn-primary btn-sm">Create Loan</button>
            <a href="{{ route('loans.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
        </form>
    </div>
</div>
   
@endsection
