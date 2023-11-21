<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\VoterController;
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

/*
Route::get('/login', function () {
    return view('login_organization');
});

Route::get('/register', function () {
    return view('signup_organization');
});
*/

/*
Route::get('/candid', function () {
    return view('org/candidate');
});
*/

//Route::post('register-admin', [adminController::class, 'customRegistration'])->name('register.admin'); 
Route::post('login-admin', [adminController::class, 'adminLogin'])->name('login.admin'); 
Route::get('logoutAdmin', [adminController::class, 'logout'])->name('logoutAdmin');

Route::group(['middleware'=>['adminCheck']], function(){
    Route::get('loginAdmin', [adminController::class, 'loginAdmin'])->name('loginAdmin');
    Route::get('adminDashboard', [adminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('viewOrganization', [adminController::class, 'viewOrganization'])->name('viewOrganization');
    Route::get('activityLog', [adminController::class, 'activityLog'])->name('activityLog');
    Route::get('orgProfile/{id}', [adminController::class, 'orgProfile']);

});


Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::post('submitOtp', [CustomAuthController::class, 'submitOtp'])->name('submitOtp');

Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('logoutEmail', [CustomAuthController::class, 'logoutEmail'])->name('logoutEmail');

Route::post('verifyOrg', [CustomAuthController::class, 'verifyOrg'])->name('verify.org');

Route::post('searchEmail', [CustomAuthController::class, 'searchEmail'])->name('search.email');

Route::get('resendOtp/{email}', [CustomAuthController::class, 'resendOtp'])->name('resend.otp'); 
// Route::get('privacy-policy', [CustomAuthController::class, 'privacyPolicy'])->name('privacy.policy');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
});


Route::get('resendToVerifyOrg/{email}',[CustomAuthController::class, 'resendToVerifyOrg'])->name('resend.verify.org');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('index', [CustomAuthController::class, 'index'])->name('index');
    
    Route::get('login', [CustomAuthController::class, 'login'])->name('login');
    Route::get('forgot-password', [CustomAuthController::class, 'forgot'])->name('identify');
    Route::get('change-password', [CustomAuthController::class, 'changePassword'])->name('change.password');

    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');

    
    Route::get('otpForm', [CustomAuthController::class, 'otpForm'])->name('otp.form');
    Route::get('verifyForm', [CustomAuthController::class, 'verifyForm'])->name('verify.form');

    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

    Route::get('org-profile',[CustomAuthController::class, 'orgProfile'])->name('orgProfile');
    Route::post('changeProfile',[CustomAuthController::class, 'changeProfile'])->name('change.profile');
    Route::get('change-email',[CustomAuthController::class, 'changeEmailOtp'])->name('change.email.otp');
    Route::get('resendEmailOtp/{email}', [CustomAuthController::class, 'resendEmailOtp'])->name('resend.email.otp');
    Route::post('changeEmail',[CustomAuthController::class, 'changeEmail'])->name('change.email');
    Route::post('submitEmailOtp',[CustomAuthController::class, 'submitEmailOtp'])->name('submit.email.otp');
    
    Route::post('createElection', [CustomAuthController::class, 'createElection'])->name('create.election');
    Route::post('resetElection', [CustomAuthController::class, 'resetElection'])->name('reset.election');

    Route::get('positions', [CustomAuthController::class, 'positions'])->name('positions');
    Route::post('createPosition', [CustomAuthController::class, 'createPosition'])->name('create.position');
    Route::post('createRepresentative', [CustomAuthController::class, 'createRepresentative'])->name('create.representative');
    Route::post('deletePosition', [CustomAuthController::class, 'deletePosition'])->name('delete.position');

    Route::get('partylist', [CustomAuthController::class, 'partylist'])->name('partylist');
    Route::post('addParty', [CustomAuthController::class, 'addParty'])->name('add.party');
    Route::post('deleteParty', [CustomAuthController::class, 'deleteParty'])->name('delete.party');
    
    Route::get('candidates', [CustomAuthController::class, 'candidates'])->name('candidates');
    Route::post('addCandidate', [CustomAuthController::class,'addCandidate']);
    Route::get('candidate-profile/{id}',[CustomAuthController::class, 'candidateProfile'])->name('candidate.profile');
    Route::post('disqualifyCandidate', [CustomAuthController::class, 'disqualifyCandidate'])->name('disqualify.candidate');
    Route::post('deleteCandidate', [CustomAuthController::class, 'deleteCandidate'])->name('delete.candidate');
    Route::get('previewballot', [CustomAuthController::class, 'ballot'])->name('previewBallot');
    Route::get('candidateArchive', [CustomAuthController::class, 'candidateArchive'])->name('candidateArchive');
    Route::get('restoreCandidate/{id}', [CustomAuthController::class, 'restoreCandidate'])->name('restore.candidate');

    Route::get('voters', [CustomAuthController::class, 'voters'])->name('voters');
    Route::post('addVoter', [CustomAuthController::class, 'addVoter'])->name('add.voter');
    Route::post('importVoter', [CustomAuthController::class, 'importVoter'])->name('import.voter');
    Route::post('deleteVoter', [CustomAuthController::class, 'deleteVoter'])->name('delete.voter');
    Route::get('viewVoter/{id}', [CustomAuthController::class, 'viewVoter'])->name('view.voter');
    Route::get('voter-archives', [CustomAuthController::class, 'voterArchive'])->name('voter.archives');
    Route::get('restoreVoter/{id}',[CustomAuthController::class, 'restoreVoter'])->name('restore.voter');

    Route::get('results', [CustomAuthController::class, 'results'])->name('results');
    Route::get('election-result/{position}',[CustomAuthController::class, 'positionResult'])->name('election.position');
    Route::get('election-result-candidates/{id}',[CustomAuthController::class, 'candidateResult'])->name('election.candidates');  
    Route::get('tablePdf', [CustomAuthController::class, 'tablePdf'])->name('table.pdf');
    Route::get('generate-pdf', [CustomAuthController::class, 'generatePDF'])->name('generate.pdf');
    
});

Route::post('login-voter', [VoterController::class, 'voterLogin'])->name('login.voter'); 
Route::get('resendVoterOtp/{email}', [VoterController::class, 'resendVoterOtp'])->name('resend.voter.otp'); 
Route::post('submitVoterOtp', [VoterController::class, 'submitVoterOtp'])->name('submitVoterOtp');
Route::get('logoutVoter', [VoterController::class, 'logout'])->name('logoutVoter');


Route::group(['middleware'=>['voterCheck']], function(){
    Route::get('loginVoter', [VoterController::class, 'loginVoter'])->name('loginVoter');
    Route::get('verifyVoter', [VoterController::class, 'verifyVoter'])->name('verify.voter');

    Route::get('ballot', [VoterController::class, 'ballot'])->name('ballot');
    Route::post('reviewVotes',[VoterController::class, 'reviewVotes'])->name('review.votes');
    Route::get('reviewForm',[VoterController::class, 'reviewForm'])->name('review.form');
    Route::get('submitForm',[VoterController::class, 'submitForm'])->name('submit.form');
    Route::get('voter-profile',[VoterController::class, 'voterProfile'])->name('voter.profile');
    Route::post('changeVoterProfile', [VoterController::class, 'changeVoterProfile'])->name('change.voter.profile');


});



