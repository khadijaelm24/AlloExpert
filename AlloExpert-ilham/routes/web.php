<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardClientController;
use App\Http\Controllers\DashboardPartenaireController;
use App\Http\Controllers\ServiceController;

// Pour afficher la page d'acceuil
Route::get('/', function () {
    return view('index');
})->name('index');

// Pour l'inscription
// Afficher la page de sign up
Route::get('/register',[RegisterController::class,'register'])->name('register');
// Traitement backend du signup
Route::post('/register',[RegisterController::class,'registerPost'])->name('register');

// Pour la connexion
// Afficher la page de login
Route::get('/login',[LoginController::class,'login'])->name('login');
// Traitement backend du login
Route::post('/login',[LoginController::class,'loginPost'])->name('login');

// Pour le tableau de bord client
// Afficher le tableau de bord client
Route::get('/dashboard_client',[DashboardClientController::class,'dashboardclient'])->name('dashboard_client');
// Se deconnecter
Route::delete('/logout', [DashboardClientController::class,'logout'])->name('logout');

// Pour le tableau de bord partenaire
// Afficher le tableau de bord partenaire
Route::get('/dashboard_partenaire',[DashboardPartenaireController::class,'dashboardpartenaire'])->name('dashboard_partenaire');
// Se deconnecter
Route::delete('/logout', [DashboardPartenaireController::class,'logout'])->name('logout');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
//pour afficher le profile de client
Route::get('/profile', [DashboardClientController::class, 'ProfileForm'])->name('profile');
//pour editer le profile
Route::get('/edit_profile', [DashboardClientController::class, 'editProfile'])->name('edit-profile');
//update-profile
Route::put('/update-profile', [DashboardClientController::class, 'updateProfile'])->name('update-profile');

