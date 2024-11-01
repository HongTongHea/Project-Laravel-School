@extends('layouts.app')

@section('title', 'Edit Loan')

@section('app-content')
    <div class="card">
        <div class="card-body">
            <h1>Edit Loan</h1>

            <form action="{{ route('loans.update', $loan->LoanID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="BorrowerID">Borrower ID</label>
                    <input type="number" name="BorrowerID" id="BorrowerID" class="form-control"
                        value="{{ old('BorrowerID', $loan->BorrowerID) }}" required>
                </div>

                <div class="form-group">
                    <label for="LoanAmount">Loan Amount</label>
                    <input type="number" name="LoanAmount" id="LoanAmount" class="form-control"
                        value="{{ old('LoanAmount', $loan->LoanAmount) }}" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="InterestRate">Interest Rate</label>
                    <input type="number" name="InterestRate" id="InterestRate" class="form-control"
                        value="{{ old('InterestRate', $loan->InterestRate) }}" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="LoanTerm">Loan Term (Months)</label>
                    <input type="number" name="LoanTerm" id="LoanTerm" class="form-control"
                        value="{{ old('LoanTerm', $loan->LoanTerm) }}" required>
                </div>

                <div class="form-group">
                    <label for="StartDate">Start Date</label>
                    <input type="date" name="StartDate" id="StartDate" class="form-control"
                        value="{{ old('StartDate', $loan->StartDate) }}" required>
                </div>

                <div class="form-group">
                    <label for="EndDate">End Date</label>
                    <input type="date" name="EndDate" id="EndDate" class="form-control"
                        value="{{ old('EndDate', $loan->EndDate) }}">
                </div>

                <div class="form-group">
                    <label for="PaymentType">Payment Type</label>
                    <select name="PaymentType" id="PaymentType" class="form-control" required>
                        <option value="">Select Payment Type</option>
                        <option value="Monthly Installments"
                            {{ old('PaymentType', $loan->PaymentType ?? '') == 'Monthly Installments' ? 'selected' : '' }}>
                            Monthly Installments</option>
                        <option value="Bi-Weekly Installments"
                            {{ old('PaymentType', $loan->PaymentType ?? '') == 'Bi-Weekly Installments' ? 'selected' : '' }}>
                            Bi-Weekly Installments</option>
                        <option value="Weekly Installments"
                            {{ old('PaymentType', $loan->PaymentType ?? '') == 'Weekly Installments' ? 'selected' : '' }}>
                            Weekly Installments</option>
                        <option value="One-Time Payment"
                            {{ old('PaymentType', $loan->PaymentType ?? '') == 'One-Time Payment' ? 'selected' : '' }}>
                            One-Time Payment</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Update Loan</button>
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
