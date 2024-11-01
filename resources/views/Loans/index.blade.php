@extends('layouts.app')

@section('title', 'Loans')

@section('app-content')
    <div class="card rounded-0">
        <div class="card-body">
            <h1>Loans</h1>
            <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm mb-3">Add New Loan</a>
            <table class="table table-sm table-hover table-responsive border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>B-ID</th>
                        <th>L-Amount</th>
                        <th>Interest Rate</th>
                        <th>L-Term</th>
                        <th>S-Date</th>
                        <th>E-Date</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $loan->BorrowerID }}</td>
                            <td>{{ $loan->LoanAmount }}</td>
                            <td>{{ $loan->InterestRate }}%</td>
                            <td>{{ $loan->LoanTerm }} months</td>
                            <td>{{ $loan->StartDate }}</td>
                            <td>{{ $loan->EndDate }}</td>
                            <td>{{ $loan->PaymentType }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('loans.show', $loan->LoanID) }}" class="dropdown-item">View
                                                Schedule</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('loans.edit', $loan->LoanID) }}"
                                                class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('loans.destroy', $loan->LoanID) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection
