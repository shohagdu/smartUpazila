<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UnionInfoController;
use App\Http\Controllers\AllTypeTitleController;
use App\Http\Controllers\UpazilaRelatedController;
use App\Http\Controllers\UpazilaParishadController;
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
// union setup area end 

// all type title area start 
Route::get('/all-type-title', [AllTypeTitleController::class, 'index'])->name('setup.all_type_title');
Route::post('/all-type-title/store', [AllTypeTitleController::class, 'store'])->name('all_type_title.store');
Route::post('/all-type-title/edit', [AllTypeTitleController::class, 'edit'])->name('all_type_title.edit');
Route::post('/all-type-title/delete', [AllTypeTitleController::class, 'destroy'])->name('all_type_title.delete');
// all type title area end 

// upazilaIntroduction area start 
Route::get('/upazilaIntroduction', [UpazilaRelatedController::class, 'index'])->name('upazila_related.upazilaIntroduction');
Route::post('/upazilaIntroduction/store', [UpazilaRelatedController::class, 'store'])->name('upazilaIntroduction.store');
Route::post('/upazilaIntroduction/edit', [UpazilaRelatedController::class, 'edit'])->name('upazilaIntroduction.edit');
Route::post('/upazilaIntroduction/update', [UpazilaRelatedController::class, 'update'])->name('upazilaIntroduction.update');
Route::post('/upazilaIntroduction/delete', [UpazilaRelatedController::class, 'destroy'])->name('upazilaIntroduction.delete');


Route::get('/upazilaHistory', [UpazilaRelatedController::class, 'up_history'])->name('upazila_related.up_history');
Route::post('/up-history/store', [UpazilaRelatedController::class, 'up_history_store'])->name('up_history.store');

Route::get('/upazilaGeographical', [UpazilaRelatedController::class, 'upazila_geographical'])->name('upazila_related.upazila_geographical');
Route::post('/upazilaGeographical/store', [UpazilaRelatedController::class, 'upazila_geographical_store'])->name('upazila_geographical.store');

Route::get('/upPublicPeprestative', [UpazilaRelatedController::class, 'upPublicPeprestative'])->name('upazila_related.upPublicPeprestative');
Route::post('/upPublicPeprestative/store', [UpazilaRelatedController::class, 'up_public_peprestative_store'])->name('upPublicPeprestative.store');
Route::post('/upPublicPeprestative/edit', [UpazilaRelatedController::class, 'up_public_peprestative_edit'])->name('upPublicPeprestative.edit');
Route::post('/upPublicPeprestative/update', [UpazilaRelatedController::class, 'up_public_peprestative_update'])->name('upPublicPeprestative.update');
Route::post('/upPublicPeprestative/delete', [UpazilaRelatedController::class, 'up_public_peprestative_delete'])->name('upPublicPeprestative.delete');


Route::get('/freedom_fighter', [UpazilaRelatedController::class, 'freedom_fighter'])->name('upazila_related.freedom_fighter');
Route::post('/freedom_fighter/store', [UpazilaRelatedController::class, 'freedom_fighter_store'])->name('freedom_fighter.store');
Route::post('/freedom_fighter/edit', [UpazilaRelatedController::class, 'freedom_fighter_edit'])->name('freedom_fighter.edit');
Route::post('/freedom_fighter/update', [UpazilaRelatedController::class, 'freedom_fighter_update'])->name('freedom_fighter.update');
Route::post('/freedom_fighter/delete', [UpazilaRelatedController::class, 'freedom_fighter_delete'])->name('freedom_fighter.delete');


Route::get('/upazila_chairman', [UpazilaParishadController::class, 'index'])->name('upazila_parishad.upazila_chairman');
Route::get('/upazila_chairman/create', [UpazilaParishadController::class, 'create'])->name('upazila_chairman.create');
Route::post('/upazila_chairman/store', [UpazilaParishadController::class, 'store'])->name('upazila_chairman.store');
Route::get('/upazila_chairman/edit/{id}', [UpazilaParishadController::class, 'edit'])->name('upazila_chairman.edit');
Route::post('/upazila_chairman/update/{id}', [UpazilaParishadController::class, 'update'])->name('upazila_chairman.update');
Route::get('/upazila_chairman/delete/{id}', [UpazilaParishadController::class, 'destroy'])->name('upazila_chairman.delete');

Route::get('/upazila_vice_chairman', [UpazilaParishadController::class, 'vice_chairman'])->name('upazila_parishad.vice_chairman');
Route::get('/upazila_vice_chairman/create', [UpazilaParishadController::class, 'vice_chairman_create'])->name('upazila_parishad.vice_chairman_create');
Route::post('/upazila_vice_chairman/store', [UpazilaParishadController::class, 'vice_chairman_store'])->name('upazila_parishad.vice_chairman_store');
Route::get('/upazila_vice_chairman/edit/{id}', [UpazilaParishadController::class, 'vice_chairman_edit'])->name('upazila_parishad.vice_chairman_edit');
Route::post('/upazila_vice_chairman/update/{id}', [UpazilaParishadController::class, 'vice_chairman_update'])->name('upazila_parishad.vice_chairman_update');
Route::get('/upazila_vice_chairman/delete/{id}', [UpazilaParishadController::class, 'vice_chairman_delete'])->name('upazila_parishad.vice_chairman_delete');

Route::get('/upazila_female_vice_chairman', [UpazilaParishadController::class, 'female_vice_chairman'])->name('upazila_parishad.female_vice_chairman');
Route::get('/upazila_female_vice_chairman/create', [UpazilaParishadController::class, 'female_vice_chairman_create'])->name('upazila_parishad.female_vice_chairman_create');
Route::post('/upazila_female_vice_chairman/store', [UpazilaParishadController::class, 'female_vice_chairman_store'])->name('upazila_parishad.female_vice_chairman_store');
Route::get('/upazila_female_vice_chairman/edit/{id}', [UpazilaParishadController::class, 'female_vice_chairman_edit'])->name('upazila_parishad.female_vice_chairman_edit');
Route::post('/upazila_female_vice_chairman/update/{id}', [UpazilaParishadController::class, 'female_vice_chairman_update'])->name('upazila_parishad.female_vice_chairman_update');
Route::get('/upazila_female_vice_chairman/delete/{id}', [UpazilaParishadController::class, 'female_vice_chairman_delete'])->name('upazila_parishad.female_vice_chairman_delete');