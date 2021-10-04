<?php

use App\Models\User;
use App\Notifications\TaskCompleted;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

	$when = Carbon::now()->addSeconds(10);
   	User::find(1)->notify((new TaskCompleted)->delay($when));

   	// SEND NOTIFICATION VIA FACADE
   	// $users = User::find(1);
   	// Notification::send($users, new TaskCompleted());

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
