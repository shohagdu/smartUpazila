<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UnionInfoController;
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
// home page
Route::get('/', [WebsiteController::class, 'index']);
// upzila sompirkota page
Route::get('/up_introduce', [WebsiteController::class, 'up_introduce']);
Route::get('/up_history', [WebsiteController::class, 'up_history']);
Route::get('/up_geographical', [WebsiteController::class, 'up_geographical']);
Route::get('/up_public_represtative', [WebsiteController::class, 'up_public_represtative']);
Route::get('/up_fridomfighter', [WebsiteController::class, 'up_fridomfighter']);
// upzila porisad
Route::get('/up_chirman', [WebsiteController::class, 'up_chirman']);
Route::get('/up_vais_chirman', [WebsiteController::class, 'up_vais_chirman']);
Route::get('/up_mohilavais_chirman', [WebsiteController::class, 'up_mohilavais_chirman']);
Route::get('/up_frakton_chirman', [WebsiteController::class, 'up_frakton_chirman']);
Route::get('/up_karjobal', [WebsiteController::class, 'up_karjobal']);
Route::get('/up_sangotonik_katamo', [WebsiteController::class, 'up_sangotonik_katamo']);
// pourosova
Route::get('/pourosova', [WebsiteController::class, 'pourosova']);
Route::get('/mayor', [WebsiteController::class, 'mayor']);
Route::get('/councilor', [WebsiteController::class, 'councilor']);
Route::get('/pourosova_word', [WebsiteController::class, 'pourosova_word']);
Route::get('/kormokorta', [WebsiteController::class, 'kormokorta']);
Route::get('/citizen_serzer', [WebsiteController::class, 'citizen_serzer']);
Route::get('/kormocari', [WebsiteController::class, 'kormocari']);
Route::get('/sangotonik_katamo', [WebsiteController::class, 'sangotonik_katamo']);
// government office
Route::get('/low_and_order', [WebsiteController::class, 'low_and_order']);
Route::get('/health_issues', [WebsiteController::class, 'health_issues']);
Route::get('/agriculture_and_food', [WebsiteController::class, 'agriculture_and_food']);
Route::get('/land_matters', [WebsiteController::class, 'land_matters']);
Route::get('/gov_engineers', [WebsiteController::class, 'gov_engineers']);
// ornanno page
Route::get('/educational_institutions', [WebsiteController::class, 'educational_institutions']);
Route::get('/non_govern_organizations', [WebsiteController::class, 'non_govern_organizations']);
Route::get('/religious_institutions', [WebsiteController::class, 'religious_institutions']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// union setup area start 
Route::get('/unionSetup', [UnionInfoController::class, 'index'])->name('union_setup.unionSetup');
Route::post('/unionSetup/store', [UnionInfoController::class, 'store'])->name('union_setup.store');
Route::post('/unionSetup/edit', [UnionInfoController::class, 'edit'])->name('union_setup.edit');
Route::post('/unionSetup/delete', [UnionInfoController::class, 'destroy'])->name('union_setup.delete');