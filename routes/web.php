<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoanController;
// use App\Http\Controllers\LoanScheduleController;


// Route::get("/", function () {

//     $name = "Ben";
//     $age = 10;
//     $gender = "male";

//     return view("welcome", [
//         'name' => $name,
//         'age' => $age,
//         'gender' => $gender
//     ]);
// });

Route::view("home", "home");

Route::prefix('category')->group(function () {

    Route::get("/", function () {
        $cats = DB::table('categories')->get();
        return view('categories.index', compact('cats'));
    })->name('category.index');

    Route::get("create", function () {
        return view("categories.create");
    })->name('category.create');

    Route::post("/", function (Request $req) {
        $data = $req->only(['name', 'description']);
        $created = DB::table("categories")->insert($data);
        if ($created) {
            return redirect("/category");
        }
        return back();
    });

    Route::get("{id}/edit", function ($id) {
        $cat = DB::table('categories')->where("id", $id)->first();
        if ($cat)
            return view('categories.edit', compact('cat'));
        else
            return abort(404);
    });
    Route::put("{id}/edit", function (Request $req, $id) {
        $data = $req->only(['name', 'description']);
        $updated = DB::table("categories")->where("id", $id)->update($data);
        if ($updated) {
            return redirect("/category");
        }
        return back();
    });
    Route::delete("delete{id}/edit", function ($id) {

        $delete = DB::table("categories")->where("id", $id)->delete();
        if ($delete) {
            return redirect("/category");
        }
        return back();
    });
});
// routes/web.php


Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
Route::post('/customers/{id}/delete', [CustomerController::class, 'destroy'])->name('customers.delete');
Route::get('/customers/search', action: [CustomerController::class, 'search'])->name('customers.search');

Route::prefix('employees')->group(function () {

    Route::controller(EmployeeController::class)->group(function () {

        Route::get('/', 'index')->name('employees.index');

        Route::get('/create', 'create')->name('employees.create');

        Route::post('/', 'store')->name('employees.store');

        Route::get('{id}/edit', 'edit')->name('employees.edit')->whereNumber('id');

        Route::put('{id}', 'update')->name('employees.update')->whereNumber('id');

        Route::get('{id}/details', 'details')->name('employees.details')->whereNumber('id');

        Route::get('{id}/delete', 'delete')->name('employees.delete')->whereNumber('id');

        Route::delete('{id}', 'destroy')->name('employees.destroy')->whereNumber('id');
    });
});

Route::resource('loans', LoanController::class);

// Route::resource('loan_schedules', LoanScheduleController::class);
