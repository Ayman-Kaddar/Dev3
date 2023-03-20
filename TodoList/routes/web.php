<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
})->middleware("guest");

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google');

Route::get("/tasks", [TaskController::class, "index"])->name("tasks.index");

Route::post("/tasks/create", [TaskController::class, "store"])->name("tasks.store");
Route::get("/tasks/{task}/estado", [TaskController::class, "setEstado"])->name("tasks.estado");

Route::get("/tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
Route::put("/tasks/{task}/update", [TaskController::class, "update"])->name("tasks.update");

Route::delete("/tasks/{task}/delete", [TaskController::class, "destroy"])->name("tasks.destroy");

Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
Route::post("/projects/create", [ProjectController::class, "store"])->name("projects.store");

Route::get("/projects/{project}/edit", [ProjectController::class, "edit"])->name("projects.edit");
Route::put("/projects/{project}/update", [ProjectController::class, "update"])->name("projects.update");

Route::delete("/projects/{project}/delete", [ProjectController::class, "destroy"])->name("projects.destroy");


Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    
    $userExists = User::where('external_id',$user->id)->where('external_auth', 'google')->first();

    if($userExists){
        Auth::login($userExists);
    }else{
        $userNew = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'google',
        ]);

        Auth::login($userNew);
    }
    return redirect('/dashboard');
    // $user->token
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
