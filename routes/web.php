<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UnionInfoController;
use App\Http\Controllers\AllTypeTitleController;
use App\Http\Controllers\UpazilaRelatedController;
use App\Http\Controllers\UpazilaParishadController;
use App\Http\Controllers\PourosovaRelatedController;
use App\Http\Controllers\GovernmentInstitutionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FooterAreaController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\DynamicContentPageController;

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

//slider
Route::get('/slider', [UpazilaRelatedController::class, 'slider'])->name('upazila_related.slider');
Route::get('/slider/create', [UpazilaRelatedController::class, 'slider_create'])->name('upazila_related.slider_create');
Route::post('/slider/store', [UpazilaRelatedController::class, 'slider_store'])->name('upazila_related.slider_store');
Route::get('/slider/edit/{id}', [UpazilaRelatedController::class, 'slider_edit'])->name('upazila_related.slider_edit');
Route::post('/slider/update/{id}', [UpazilaRelatedController::class, 'slider_update'])->name('upazila_related.slider_update');
Route::get('/slider/delete/{id}', [UpazilaRelatedController::class, 'slider_delete'])->name('upazila_related.slider_delete');


// social media
Route::get('/social-media', [UpazilaRelatedController::class, 'social_media'])->name('upazila_related.social_media');
Route::post('/social-media/store', [UpazilaRelatedController::class, 'social_media_store'])->name('upazila_related.social_media_store');

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

// parisad kajjoboli 
Route::get('/parisad-kajjoboli', [UpazilaParishadController::class, 'parisad_kajjoboli'])->name('upazila_parishad.parisad_kajjoboli');
Route::post('/parisad-kajjoboli/store', [UpazilaParishadController::class, 'parisad_kajjoboli_store'])->name('upazila_parishad.parisad_kajjoboli_store');
Route::post('/parisad-kajjoboli/edit', [UpazilaParishadController::class, 'parisad_kajjoboli_edit'])->name('upazila_parishad.parisad_kajjoboli_edit');
Route::post('/parisad-kajjoboli/update', [UpazilaParishadController::class, 'parisad_kajjoboli_update'])->name('upazila_parishad.parisad_kajjoboli_update');
Route::post('/parisad-kajjoboli/delete', [UpazilaParishadController::class, 'parisad_kajjoboli_destroy'])->name('upazila_parishad.parisad_kajjoboli_destroy');



// Pourosova area start 
Route::get('/pourosova-at-glance', [PourosovaRelatedController::class, 'index'])->name('pourosova_related.index');
Route::post('/pourosova-at-glance/store', [PourosovaRelatedController::class, 'store'])->name('pourosova_related.store');
Route::post('/pourosova-at-glance/edit', [PourosovaRelatedController::class, 'edit'])->name('pourosova_related.edit');
Route::post('/pourosova-at-glance/update', [PourosovaRelatedController::class, 'update'])->name('pourosova_related.update');
Route::post('/pourosova-at-glance/delete', [PourosovaRelatedController::class, 'destroy'])->name('pourosova_related.delete');


Route::get('/pourosova_mayor', [PourosovaRelatedController::class, 'pourosova_mayor'])->name('pourosova_related.pourosova_mayor');
Route::get('/pourosova_mayor/create', [PourosovaRelatedController::class, 'pourosova_mayor_create'])->name('pourosova_related.pourosova_mayor_create');
Route::post('/pourosova_mayor/store', [PourosovaRelatedController::class, 'pourosova_mayor_store'])->name('pourosova_related.pourosova_mayor_store');
Route::get('/pourosova_mayor/edit/{id}', [PourosovaRelatedController::class, 'pourosova_mayor_edit'])->name('pourosova_related.pourosova_mayor_edit');
Route::post('/pourosova_mayor/update/{id}', [PourosovaRelatedController::class, 'pourosova_mayor_update'])->name('pourosova_related.pourosova_mayor_update');
Route::get('/pourosova_mayor/delete/{id}', [PourosovaRelatedController::class, 'pourosova_mayor_delete'])->name('pourosova_related.pourosova_mayor_delete');


Route::get('/pourosova_councilor', [PourosovaRelatedController::class, 'pourosova_councilor'])->name('pourosova_related.pourosova_councilor');
Route::get('/pourosova_councilor/create', [PourosovaRelatedController::class, 'pourosova_councilor_create'])->name('pourosova_related.pourosova_councilor_create');
Route::post('/pourosova_councilor/store', [PourosovaRelatedController::class, 'pourosova_councilor_store'])->name('pourosova_related.pourosova_councilor_store');
Route::get('/pourosova_councilor/edit/{id}', [PourosovaRelatedController::class, 'pourosova_councilor_edit'])->name('pourosova_related.pourosova_councilor_edit');
Route::post('/pourosova_councilor/update/{id}', [PourosovaRelatedController::class, 'pourosova_councilor_update'])->name('pourosova_related.pourosova_councilor_update');
Route::get('/pourosova_councilor/delete/{id}', [PourosovaRelatedController::class, 'pourosova_councilor_delete'])->name('pourosova_related.pourosova_councilor_delete');


Route::get('/pourosova_kormokorta', [PourosovaRelatedController::class, 'pourosova_kormokorta'])->name('pourosova_related.pourosova_kormokorta');
Route::get('/pourosova_kormokorta/create', [PourosovaRelatedController::class, 'pourosova_kormokorta_create'])->name('pourosova_related.pourosova_kormokorta_create');
Route::post('/pourosova_kormokorta/store', [PourosovaRelatedController::class, 'pourosova_kormokorta_store'])->name('pourosova_related.pourosova_kormokorta_store');
Route::get('/pourosova_kormokorta/edit/{id}', [PourosovaRelatedController::class, 'pourosova_kormokorta_edit'])->name('pourosova_related.pourosova_kormokorta_edit');
Route::post('/pourosova_kormokorta/update/{id}', [PourosovaRelatedController::class, 'pourosova_kormokorta_update'])->name('pourosova_related.pourosova_kormokorta_update');
Route::get('/pourosova_kormokorta/delete/{id}', [PourosovaRelatedController::class, 'pourosova_kormokorta_delete'])->name('pourosova_related.pourosova_kormokorta_delete');

Route::get('/pourosovaWard', [PourosovaRelatedController::class, 'pourosova_ward'])->name('pourosova_related.pourosova_ward');
Route::get('/pourosova_ward/create', [PourosovaRelatedController::class, 'pourosova_ward_create'])->name('pourosova_related.pourosova_ward_create');
Route::post('/pourosova_ward/store', [PourosovaRelatedController::class, 'pourosova_ward_store'])->name('pourosova_related.pourosova_ward_store');
Route::get('/pourosova_ward/edit/{id}', [PourosovaRelatedController::class, 'pourosova_ward_edit'])->name('pourosova_related.pourosova_ward_edit');
Route::post('/pourosova_ward/update/{id}', [PourosovaRelatedController::class, 'pourosova_ward_update'])->name('pourosova_related.pourosova_ward_update');
Route::get('/pourosova_ward/delete/{id}', [PourosovaRelatedController::class, 'pourosova_ward_delete'])->name('pourosova_related.pourosova_ward_delete');


Route::get('/pourosova_kormocari', [PourosovaRelatedController::class, 'pourosova_kormocari'])->name('pourosova_related.pourosova_kormocari');
Route::get('/pourosova_kormocari/create', [PourosovaRelatedController::class, 'pourosova_kormocari_create'])->name('pourosova_related.pourosova_kormocari_create');
Route::post('/pourosova_kormocari/store', [PourosovaRelatedController::class, 'pourosova_kormocari_store'])->name('pourosova_related.pourosova_kormocari_store');
Route::get('/pourosova_kormocari/edit/{id}', [PourosovaRelatedController::class, 'pourosova_kormocari_edit'])->name('pourosova_related.pourosova_kormocari_edit');
Route::post('/pourosova_kormocari/update/{id}', [PourosovaRelatedController::class, 'pourosova_kormocari_update'])->name('pourosova_related.pourosova_kormocari_update');
Route::get('/pourosova_kormocari/delete/{id}', [PourosovaRelatedController::class, 'pourosova_kormocari_delete'])->name('pourosova_related.pourosova_kormocari_delete');

// sangotonik_katamo
Route::get('/sangotonik-katamo', [PourosovaRelatedController::class, 'sangotonik_katamo'])->name('pourosova_related.sangotonik_katamo');
Route::post('/sangotonik-katamo/store', [PourosovaRelatedController::class, 'sangotonik_katamo_store'])->name('pourosova_related.sangotonik_katamo_store');
Route::post('/sangotonik-katamo/edit', [PourosovaRelatedController::class, 'sangotonik_katamo_edit'])->name('pourosova_related.sangotonik_katamo_edit');
Route::post('/sangotonik-katamo/update', [PourosovaRelatedController::class, 'sangotonik_katamo_update'])->name('pourosova_related.sangotonik_katamo_update');
Route::post('/sangotonik-katamo/delete', [PourosovaRelatedController::class, 'sangotonik_katamo_delete'])->name('pourosova_related.sangotonik_katamo_delete');

// Citizen's Charter
Route::get('/citizen-charter', [PourosovaRelatedController::class, 'citizen_charter'])->name('pourosova_related.citizen_charter');
Route::post('/citizen-charter/store', [PourosovaRelatedController::class, 'citizen_charter_store'])->name('pourosova_related.citizen_charter_store');
Route::post('/citizen-charter/edit', [PourosovaRelatedController::class, 'citizen_charter_edit'])->name('pourosova_related.citizen_charter_edit');
Route::post('/citizen-charter/update', [PourosovaRelatedController::class, 'citizen_charter_update'])->name('pourosova_related.citizen_charter_update');
Route::post('/citizen-charter/delete', [PourosovaRelatedController::class, 'citizen_charter_destroy'])->name('pourosova_related.citizen_charter_destroy');

// government
Route::get('/lowAndOrder', [GovernmentInstitutionController::class, 'low_and_order'])->name('pourosova_related.low_and_order');
Route::get('/low_and_order/create', [GovernmentInstitutionController::class, 'low_and_order_create'])->name('government_institution.low_and_order_create');
Route::post('/low_and_order/store', [GovernmentInstitutionController::class, 'low_and_order_store'])->name('government_institution.low_and_order_store');
Route::get('/low_and_order/edit/{id}', [GovernmentInstitutionController::class, 'low_and_order_edit'])->name('government_institution.low_and_order_edit');
Route::post('/low_and_order/update/{id}', [GovernmentInstitutionController::class, 'low_and_order_update'])->name('government_institution.low_and_order_update');
Route::get('/low_and_order/delete/{id}', [GovernmentInstitutionController::class, 'low_and_order_delete'])->name('government_institution.low_and_order_delete');

// helth issue
Route::get('/health-issues', [GovernmentInstitutionController::class, 'health_issues'])->name('government_institution.health_issues');
Route::get('/health-issues/create', [GovernmentInstitutionController::class, 'health_issues_create'])->name('government_institution.health_issues_create');
Route::post('/health-issues/store', [GovernmentInstitutionController::class, 'health_issues_store'])->name('government_institution.health_issues_store');
Route::get('/health-issues/edit/{id}', [GovernmentInstitutionController::class, 'health_issues_edit'])->name('government_institution.health_issues_edit');
Route::post('/health-issues/update/{id}', [GovernmentInstitutionController::class, 'health_issues_update'])->name('government_institution.health_issues_update');
Route::get('/health-issues/delete/{id}', [GovernmentInstitutionController::class, 'health_issues_delete'])->name('government_institution.health_issues_delete');

// agriculture-and-food
Route::get('/agriculture-and-food', [GovernmentInstitutionController::class, 'agriculture_and_food'])->name('government_institution.agriculture_and_food');
Route::get('/agriculture-and-food/create', [GovernmentInstitutionController::class, 'agriculture_and_food_create'])->name('government_institution.agriculture_and_food_create');
Route::post('/agriculture-and-food/store', [GovernmentInstitutionController::class, 'agriculture_and_food_store'])->name('government_institution.agriculture_and_food_store');
Route::get('/agriculture-and-food/edit/{id}', [GovernmentInstitutionController::class, 'agriculture_and_food_edit'])->name('government_institution.agriculture_and_food_edit');
Route::post('/agriculture-and-food/update/{id}', [GovernmentInstitutionController::class, 'agriculture_and_food_update'])->name('government_institution.agriculture_and_food_update');
Route::get('/agriculture-and-food/delete/{id}', [GovernmentInstitutionController::class, 'agriculture_and_food_delete'])->name('government_institution.agriculture_and_food_delete');

// land-matters
Route::get('/land-matters', [GovernmentInstitutionController::class, 'land_matters'])->name('government_institution.land_matters');
Route::get('/land-matters/create', [GovernmentInstitutionController::class, 'land_matters_create'])->name('government_institution.land_matters_create');
Route::post('/land-matters/store', [GovernmentInstitutionController::class, 'land_matters_store'])->name('government_institution.land_matters_store');
Route::get('/land-matters/edit/{id}', [GovernmentInstitutionController::class, 'land_matters_edit'])->name('government_institution.land_matters_edit');
Route::post('/land-matters/update/{id}', [GovernmentInstitutionController::class, 'land_matters_update'])->name('government_institution.land_matters_update');
Route::get('/land-matters/delete/{id}', [GovernmentInstitutionController::class, 'land_matters_delete'])->name('government_institution.land_matters_delete');


// govt-engineers
Route::get('/govt-engineers', [GovernmentInstitutionController::class, 'govt_engineers'])->name('government_institution.govt_engineers');
Route::get('/govt-engineers/create', [GovernmentInstitutionController::class, 'govt_engineers_create'])->name('government_institution.govt_engineers_create');
Route::post('/govt-engineers/store', [GovernmentInstitutionController::class, 'govt_engineers_store'])->name('government_institution.govt_engineers_store');
Route::get('/govt-engineers/edit/{id}', [GovernmentInstitutionController::class, 'govt_engineers_edit'])->name('government_institution.govt_engineers_edit');
Route::post('/govt-engineers/update/{id}', [GovernmentInstitutionController::class, 'govt_engineers_update'])->name('government_institution.govt_engineers_update');
Route::get('/govt-engineers/delete/{id}', [GovernmentInstitutionController::class, 'govt_engineers_delete'])->name('government_institution.govt_engineers_delete');


// educational institutions
Route::get('/educational-institutions', [GovernmentInstitutionController::class, 'educational_institutions'])->name('government_institution.educational_institutions');
Route::get('/educational-institutions/create', [GovernmentInstitutionController::class, 'educational_institutions_create'])->name('government_institution.educational_institutions_create');
Route::post('/educational-institutions/store', [GovernmentInstitutionController::class, 'educational_institutions_store'])->name('government_institution.educational_institutions_store');
Route::get('/educational-institutions/edit/{id}', [GovernmentInstitutionController::class, 'educational_institutions_edit'])->name('government_institution.educational_institutions_edit');
Route::post('/educational-institutions/update/{id}', [GovernmentInstitutionController::class, 'educational_institutions_update'])->name('government_institution.educational_institutions_update');
Route::get('/educational-institutions/delete/{id}', [GovernmentInstitutionController::class, 'educational_institutions_delete'])->name('government_institution.educational_institutions_delete');


// non_govt_organizations
Route::get('/non_govt-organizations', [GovernmentInstitutionController::class, 'non_govt_organizations'])->name('government_institution.non_govt_organizations');
Route::get('/non_govt-organizations/create', [GovernmentInstitutionController::class, 'non_govt_organizations_create'])->name('government_institution.non_govt_organizations_create');
Route::post('/non_govt-organizations/store', [GovernmentInstitutionController::class, 'non_govt_organizations_store'])->name('government_institution.non_govt_organizations_store');
Route::get('/non_govt-organizations/edit/{id}', [GovernmentInstitutionController::class, 'non_govt_organizations_edit'])->name('government_institution.non_govt_organizations_edit');
Route::post('/non_govt-organizations/supdate/{id}', [GovernmentInstitutionController::class, 'non_govt_organizations_update'])->name('government_institution.non_govt_organizations_update');
Route::get('/non_govt-organizations/delete/{id}', [GovernmentInstitutionController::class, 'non_govt_organizations_delete'])->name('government_institution.non_govt_organizations_delete');

// religious institutions
Route::get('/religious-institutions', [GovernmentInstitutionController::class, 'religious_institutions'])->name('government_institution.religious_institutions');
Route::get('/religious-institutions/create', [GovernmentInstitutionController::class, 'religious_institutions_create'])->name('government_institution.religious_institutions_create');
Route::post('/religious-institutions/store', [GovernmentInstitutionController::class, 'religious_institutions_store'])->name('government_institution.religious_institutions_store');
Route::get('/religious-institutions/edit/{id}', [GovernmentInstitutionController::class, 'religious_institutions_edit'])->name('government_institution.religious_institutions_edit');
Route::post('/religious-institutions/supdate/{id}', [GovernmentInstitutionController::class, 'religious_institutions_update'])->name('government_institution.religious_institutions_update');
Route::get('/religious-institutions/delete/{id}', [GovernmentInstitutionController::class, 'religious_institutions_delete'])->name('government_institution.religious_institutions_delete');


// Notice
Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
Route::get('/notice/create', [NoticeController::class, 'create'])->name('notice.create');
Route::post('/notice/store', [NoticeController::class, 'store'])->name('notice.store');
Route::get('/notice/edit/{id}', [NoticeController::class, 'edit'])->name('notice.edit');
Route::post('/notice/update/{id}', [NoticeController::class, 'update'])->name('notice.update');
Route::get('/notice/delete/{id}', [NoticeController::class, 'destroy'])->name('notice.delete');
Route::post('/notice/search', [NoticeController::class, 'search'])->name('notice.search');

// foter area
Route::get('/footer-area', [FooterAreaController::class, 'index'])->name('footer_area.index');
Route::get('/footer-area/privacy-policy', [FooterAreaController::class, 'privacy_policy'])->name('footer_area.privacy_policy');
Route::post('/footer-area/privacy-policy/store', [FooterAreaController::class, 'privacy_policy_store'])->name('footer_area.privacy_policy_store');
Route::get('/footer-area/terms-of-use', [FooterAreaController::class, 'terms_of_use'])->name('footer_area.terms_of_use');
Route::post('/footer-area/terms-of-use/store', [FooterAreaController::class, 'terms_of_use_store'])->name('footer_area.terms_of_use_store');
Route::get('/footer-area/in-overall-cooperation', [FooterAreaController::class, 'in_overall_cooperation'])->name('footer_area.in_overall_cooperation');
Route::post('/footer-area/in-overall-cooperation/store', [FooterAreaController::class, 'in_overall_cooperation_store'])->name('footer_area.in_overall_cooperation_store');
Route::get('/footer-area/sitemap', [FooterAreaController::class, 'sitemap'])->name('footer_area.sitemap');\
Route::post('/footer-area/sitemap/store', [FooterAreaController::class, 'sitemap_store'])->name('footer_area.sitemap_store');
Route::get('/footer-area/commonly-asked', [FooterAreaController::class, 'commonly_asked'])->name('footer_area.commonly_asked');
Route::post('/footer-area/commonly-asked/store', [FooterAreaController::class, 'commonly_asked_store'])->name('footer_area.commonly_asked_store');

Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/create', [PeopleController::class, 'create'])->name('people.create');
Route::post('/people/store', [PeopleController::class, 'store'])->name('people.store');
Route::get('/people/edit/{id}', [PeopleController::class, 'edit'])->name('people.edit');
Route::post('/people/update/{id}', [PeopleController::class, 'update'])->name('people.update');
Route::get('/people/delete/{id}', [PeopleController::class, 'destroy'])->name('people.delete');


// DynamicContentPage
Route::get('/dynamic-content-page', [DynamicContentPageController::class, 'index'])->name('dynamic_content_page.index');
Route::get('dynamic-content-page/create', [DynamicContentPageController::class, 'create'])->name('dynamic_content_page.create');
Route::post('/dynamic-content-page/store', [DynamicContentPageController::class, 'store'])->name('dynamic_content_page.store');
Route::get('/dynamic-content-page/edit/{id}', [DynamicContentPageController::class, 'edit'])->name('dynamic_content_page.edit');
Route::post('/dynamic-content-page/update/{id}', [DynamicContentPageController::class, 'update'])->name('dynamic_content_page.update');
Route::get('/dynamic-content-page/delete/{id}', [DynamicContentPageController::class, 'destroy'])->name('dynamic_content_page.delete');