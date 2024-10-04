<?php

use Illuminate\Support\Facades\Route;




use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');


Route::resource('/departements', 'App\Http\Controllers\DepartementController', ['names' => 'departements'])->middleware('auth:admin');;
Route::resource('/classifications', 'App\Http\Controllers\ClassificationController', ['names' => 'classifications'])->middleware('auth:admin');
Route::resource('/postes', 'App\Http\Controllers\PostesController', ['names' => 'postes'])->middleware('auth:admin');
Route::resource('/users', 'App\Http\Controllers\UsersController', ['names' => 'users'])->middleware('auth:admin');
Route::resource('/primes', 'App\Http\Controllers\PrimeController', ['names' => 'primes'])->middleware('auth:admin');
Route::post('/import','App\Http\Controllers\UsersController@import')->name('import')->middleware('auth:admin');
Route::get('/nature','App\Http\Controllers\PrimeController@getnature')->name('nature')->middleware('auth:admin');
Route::get('/search','App\Http\Controllers\StatistiqueController@getsearch')->name('search')->middleware('auth:admin');
Route::get('/showing','App\Http\Controllers\Auth\AdminController@show')->name('showing')->middleware('auth:admin');
Route::post('/edit_admins/{id}','App\Http\Controllers\Auth\AdminController@edit')->name('edit_admins')->middleware('auth:admin');
Route::resource('/config_primes', 'App\Http\Controllers\Config_primesController', ['names' => 'config_primes'])->middleware('auth:admin');

Route::resource('/typedocs', 'App\Http\Controllers\TypeDocController', ['names' => 'typedocs'])->middleware('auth:admin');

Route::resource('/absences', 'App\Http\Controllers\AbsenceController', ['names' => 'absences'])->middleware('auth:admin');
Route::resource('/conges', 'App\Http\Controllers\CongesController', ['names' => 'conges'])->middleware('auth:admin');
Route::resource('/config_conges', 'App\Http\Controllers\Config_congesController', ['names' => 'config_conges'])->middleware('auth:admin');
Route::resource('/dashboard', 'App\Http\Controllers\DashboardController', ['names' => 'dashboard'])->middleware('auth:admin');
Route::resource('/missions', 'App\Http\Controllers\MissionController', ['names' => 'missions'])->middleware('auth:admin');
Route::resource('/bulletins', 'App\Http\Controllers\BulletinController', ['names' => 'bulletins'])->middleware('auth:admin');
Route::resource('/heures', 'App\Http\Controllers\HeureController', ['names' => 'heures'])->middleware('auth:admin');
Route::resource('/avances', 'App\Http\Controllers\AvanceController', ['names' => 'avances'])->middleware('auth:admin');
Route::resource('/notes', 'App\Http\Controllers\NoteController', ['names' => 'notes'])->middleware('auth:admin');
Route::resource('/pointages', 'App\Http\Controllers\pointageController', ['names' => 'pointages'])->middleware('auth:admin');
Route::resource('/evaluations', 'App\Http\Controllers\NotationController', ['names' => 'evaluations'])->middleware('auth:admin');
Route::resource('/archives', 'App\Http\Controllers\ArchivesController', ['names' => 'archives'])->middleware('auth:admin');
Route::post('/absences/edit/{id}', 'App\Http\Controllers\AbsenceController@edited')->name('absences.edited')->middleware('auth:admin');

Route::get('/absences/print/{id}', 'App\Http\Controllers\AbsenceController@printing')->name('absences.print')->middleware('auth:admin');
Route::post('/pointag', 'App\Http\Controllers\pointageController@edited')->name('pointag')->middleware('auth:admin');
Route::get('/list_users', 'App\Http\Controllers\UsersController@getusers')->name('list_users')->middleware('auth:admin');
Route::get('/bulletins/edited/{id}/{ids}', 'App\Http\Controllers\BulletinController@printing')->name('bulletins.edited')->middleware('auth:admin');
Route::get('/fiscalites', 'App\Http\Controllers\BulletinController@getfiscalite')->name('fiscalites')->middleware('auth:admin');
Route::resource('/statistiques', 'App\Http\Controllers\StatistiqueController', ['names' => 'statistiques'])->middleware('auth:admin');
Route::resource('/declarations', 'App\Http\Controllers\DeclarationController', ['names' => 'declarations'])->middleware('auth:admin');
Route::post('admin/logout/submit', 'App\Http\Controllers\Auth\LoginController@adminLogout')->name('admin.logout.submit');
Route::post('customer/import', [App\Http\Controllers\ClassificationController::class, 'importExcelData']);
Route::post('cust/import', [App\Http\Controllers\UsersController::class, 'importExcelData']);



//backend coté utilisateur
Route::get('/bord', 'App\Http\Controllers\ProfilController@getdasboard')->name('bord')->middleware('auth');
Route::get('/absence', 'App\Http\Controllers\AbsenceController@getabsence')->name('absence')->middleware('auth');
Route::post('/conge', 'App\Http\Controllers\CongesController@postconge')->name('conge')->middleware('auth');
Route::delete('/conge/{id}', 'App\Http\Controllers\CongesController@destroyconge')->name('conge.destroyconge')->middleware('auth');
Route::get('/addconge', 'App\Http\Controllers\CongesController@getconges')->name('addconge')->middleware('auth');
Route::get('/pointage', 'App\Http\Controllers\pointageController@getpointage')->name('pointage')->middleware('auth');
Route::post('/pointage', 'App\Http\Controllers\pointageController@postpointage')->name('pointage')->middleware('auth');
Route::get('/bulletin', 'App\Http\Controllers\BulletinController@getting')->name('bulletin')->middleware('auth');
Route::post('/absence', 'App\Http\Controllers\AbsenceController@postabsence')->name('absence')->middleware('auth');
Route::get('/absence/create', 'App\Http\Controllers\AbsenceController@createabsence')->name('absence.create')->middleware('auth');
Route::delete('/absence/delete/{id}', 'App\Http\Controllers\AbsenceController@deleteabsence')->name('absence.delete')->middleware('auth');
Route::put('/absence/update/{id}', 'App\Http\Controllers\AbsenceController@updateabsence')->name('absence.update')->middleware('auth');


