<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewCOntroller;
use App\Http\Controllers\EMailSampleController;
// use App\Jobs\SendEmailJob;

// Route :: controller(NewCOntroller::class)->group(function(){
//     Route::get('/', 'showhome')->name('home');
//     Route::get('/about', 'showabout')->name('about');
//     Route::get('/contact', 'showcontact')->name('contact');
// });

// Route::get('/',function(){
//     return view('welcome');
// });


Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[NewCOntroller::class, 'showlogin'])->name('login');
    Route::post('/login_test',[NewCOntroller::class, 'login'])->name('login_test');
    Route::get('/register',[NewCOntroller::class, 'register'])->name('register');
    Route::post('/register',[NewCOntroller::class, 'registerPost'])->name('register');
});

Route::group(['middleware'=>'auth'],function(){
        Route::get('/home',[NewCOntroller::class, 'showhome'])->name('home');
        Route::get('/about',[NewCOntroller::class, 'showabout'])->name('about');
        Route::get('/contact', [NewCOntroller::class, 'showcontact'])->name('contact');
        Route::get('/logout',[NewCOntroller::class, 'logout'])->name('logout');
        Route::post('/emails',[NewCOntroller::class, 'table_mail'])->name('emails');
        Route::get('/email-sent',[NewCOntroller::class, 'mail'])->name('email-sent');

        Route::get('/search',[NewCOntroller::class, 'showtable'])->name('search');
        Route::post('/dellall',[NewCOntroller::class, 'delallrecord'])->name('del');
        Route::post('/insert',[NewCOntroller::class, 'insertrecord'])->name('insertrec');
        Route::get('/delete/{id}',[NewCOntroller::class, 'delrecord'])->name('delete');
        Route::any('/record/{id}',[NewCOntroller::class, 'updatedrecord'])->name('record');
        Route::any('/edit/{id}',[NewCOntroller::class, 'edit'])->name('edit');
});