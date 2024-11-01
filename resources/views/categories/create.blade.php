@extends('layouts.app')

@section('app-content')

        <div class="card rounded-0">
            <div class="card-body ">
                <h1>Create New Category</h1>
                <form method="post" action="/category">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control " />
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" width="10%"></textarea>
                        </div>

                    </div>
                    <button class="btn btn-sm btn-danger mt-3">Create</button>
                    <a href="{{ url('category') }}" class="btn btn-sm btn-primary mt-3">back</a>

                </form>
            </div>
        </div>

@endsection