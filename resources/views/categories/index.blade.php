@extends('layouts.app')

@section('title' ,'Categories')

@section('app-content')
    <div class="card">
        <div class="card-body">
            <h1>Categories</h1>
            <table class="table table-sm table-hover  table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cats as $c)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->description }}</td>
                            <td class="d-flex align-item-center justify-content-start">
                                <a class="btn btn-sm btn-info ms-2" href="{{ url('category/create') }}"><i
                                        class="bi bi-plus-circle"></i> New</a>
                                <a class="btn btn-sm btn-primary ms-2" href="/category/{{ $c->id }}/edit">
                                    <i class="bi bi-pencil-square"></i>
                                        </a>
                                <form action="{{ url('category/delete', ['id' => $c->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-primary ms-2"><i class="bi bi-trash"></i></a>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="3">
                                No data found.
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
