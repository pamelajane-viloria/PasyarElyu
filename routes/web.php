<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Login & Register
Route::get('/register', function () {
    return view('create_user');
});

Route::get('/login', function () {
    return view('login_user');
});

// Protect a route for ADMIN only
Route::get('/admin-dashboard', function () {
    return view('admin_dashboard');
})->middleware('role:ADMIN');

// // Protect a route for LGU only
// Route::get('/lgu-dashboard', function () {
//     return view('lgu_dashboard');
// })->middleware('role:LGU');

// // Protect a route for USER only
// Route::get('/user-dashboard', function () {
//     return view('home');
// })->middleware('role:USER');