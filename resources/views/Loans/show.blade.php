<!-- resources/views/loans/show.blade.php -->
@extends('layouts.app')

@section('title', 'Loan Details')

@section('app-content')
    <div class="card">
        <div class="card-body">
            <h1>Loan Details</h1>
            <table class="table table-sm table-hover table-responsive border">
                <tr>
                    <th>Loan ID:</th>
                    <td>{{ $loan->LoanID }}</td>
                </tr>
                <tr>
                    <th>Borrower ID:</th>
                    <td>{{ $loan->BorrowerID }}</td>
                </tr>
                <tr>
                    <th>Loan Amount:</th>
                    <td>{{ $loan->LoanAmount }}</td>
                </tr>
                <tr>
                    <th>Interest Rate:</th>
                    <td>{{ $loan->InterestRate }}%</td>
                </tr>
                <tr>
                    <th>Loan Term:</th>
                    <td>{{ $loan->LoanTerm }} months</td>
                </tr>
                <tr>
                    <th>Start Date:</th>
                    <td>{{ $loan->StartDate }}</td>
                </tr>
                <tr>
                    <th>End Date:</th>
                    <td>{{ $loan->EndDate }}</td>
                </tr>
                <tr>
                    <th>Payment Type:</th>
                    <td>{{ $loan->PaymentType }}</td>
                </tr>
            </table>

            <h2>Payment Schedule</h2>
            <table class="table table-sm table-hover table-responsive border">
                <thead>
                    <tr>
                        <th>Payment Date</th>
                        <th>Payment Amount</th>
                        <th>Principal Paid</th>
                        <th>Interest Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loan->schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->PaymentDate }}</td>
                            <td>{{ $schedule->PaymentAmount }}</td>
                            <td>{{ $schedule->PrincipalPaid }}</td>
                            <td>{{ $schedule->InterestPaid }}</td>
                            <td>{{ $schedule->Balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('loans.index') }}" class="btn btn-secondary btn-sm">Back to Loans</a>
        </div>
    </div>
@endsection
