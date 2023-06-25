<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\TestController;
use App\Http\Controllers\Admin\Auth\TestScheduleController;
use App\Http\Controllers\Admin\Auth\TestTaskController;
use App\Http\Controllers\Admin\Auth\TestResultController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Route::get('login', [AuthenticatedSessionController::class, 'create'])
    //             ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    
    Route::controller(TestController::class)->group(function()
    {
        Route::get('schedule/index','create')->name('schedule');
        Route::get('task/index','test')->name('test');
        Route::get('result/index','result')->name('result');
    });

    Route::controller(TestScheduleController::class)->group(function()
    {
        Route::get('schedule/register','create')->name('testregister');
        Route::post('test_register','store')->name('test_register');
        Route::get('schedule/edit/{id}','edit')->name('edit');
        Route::post('schedule/update/{id}','update')->name('update');
        Route::get('schedule/delete/{id}','delete')->name('delete');
        Route::get('schedule/detail/{id}','detail')->name('detail');
    });
    Route::controller(TestTaskController::class)->group(function()
    {
        Route::get('task/register/{id}','show')->name('taskregister');
        Route::post('task/register/{id}','register')->name('task_register');
        Route::get('task/edit/{id}','edit')->name('task_edit');
        Route::post('task/update/{id}','update')->name('task_update');
        Route::get('task/delete/{id}','delete')->name('task_delete');
        Route::get('task/detail/{id}','detail')->name('task_detail');
    });

    Route::controller(TestResultController::class)->group(function()
    {
        Route::get('result/edit/{id}','edit')->name('result_edit');
        Route::post('result/update/{id}','update')->name('result_update');
        Route::get('result/delete/{id}','delete')->name('result_delete');
        Route::get('result/detail/{id}','detail')->name('result_detail');
    });

    
});
