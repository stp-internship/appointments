<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;



Route::get('/', [AppointmentController::class, 'getAppointments'])->name('appointments.get');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{appointment}', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::post('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
