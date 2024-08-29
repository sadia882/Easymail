<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\LoginController;

// use App\Http\Controllers\ForgotPasswordController;
// use App\Http\Controllers\ResetPasswordController;

// Routes d'authentification
//Route::auth();
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route::post('/register', [RegisterController::class, 'registre']);
//recuperer les donnees du user
// Route::get('/users/{id}', [RegisterController::class, 'show']);

// Route::get('/users/{id}', [RegisterController::class, 'show']);
// Route::get('/users', [RegisterController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login']);

// Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
// Route::post('password/reset', [ResetPasswordController::class, 'reset']);

// Route pour envoyer le lien de réinitialisation de mot de passe
// Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route pour afficher le formulaire de réinitialisation de mot de passe
// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route pour soumettre la demande de réinitialisation de mot de passe
// Route::post('update/password', [ResetPasswordController::class, 'reset'])->name('password.update');



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp']);
// Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword']);

// Autres routes
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

///...........................................................................

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
// routes/web.php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgrammingMailController;



Route::get('/email', [EmailController::class, 'create']);
Route::post('/email', [EmailController::class, 'send']);
Route::get('/emails', [EmailController::class, 'index'])->name('emails.index'); // Route pour afficher tous les emails
Route::delete('/email/{id}', [EmailController::class, 'destroy'])->name('emails.destroy'); // Route pour supprimer un email


Route::post('/send-email', [EmailesController::class, 'sendEmail']);
Route::get('/emails', [EmailesController::class, 'getSentEmails']);
Route::get('/test-files', [EmailesController::class, 'testFiles']);




Route::post('/schedule-email', [ProgrammingMailController::class, 'scheduleEmail']);


// Assurez-vous que l'utilisateur est authentifié avant d'accéder aux routes


// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
    Route::get('/onecontact/{userId}', [ContactController::class, 'getContactsByUser']);

    
// });


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route pour enregistrer un nouvel utilisateur
Route::post('/register', [RegisterController::class, 'registre']);
Route::put('/users/{id}', [ContactController::class, 'update']);


// Route pour récupérer les données d'un utilisateur par ID
Route::get('/users/{id}', [RegisterController::class, 'show']);

// Route pour récupérer tous les utilisateurs
Route::get('/users', [RegisterController::class, 'index']);

// Route pour authentifier un utilisateur
Route::post('/login', [LoginController::class, 'login']);

// Route pour envoyer le lien de réinitialisation de mot de passe
// Route::post('/password-forgot', [PasswordResetController::class, 'sendResetLinkEmail']);

// // Route pour afficher le formulaire de réinitialisation de mot de passe
// Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');


// Route::post('/password/reset', [PasswordResetController::class, 'reset']);

Route::post('password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);


// //signature et profil 
// Route::post('/user/profile/photo', [UserController::class, 'updateProfilePhoto']);
// Route::post('/user/profile/signature', [UserController::class, 'updateSignature']);

//Création d'Utilisateurs
Route::post('/admin/users', [UserController::class, 'store'])->middleware('auth:api');
//Suppression d'Utilisateurs
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->middleware('auth:api');

Route::post('/admin/roles', [RoleController::class, 'assignRole'])->middleware('auth:api');
Route::post('/admin/permissions', [PermissionController::class, 'assignPermission'])->middleware('auth:api');

 

// Route pour obtenir les informations de l'utilisateur authentifié (nécessite une authentification via Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//
// Route pour envoyer le lien de réinitialisation de mot de passe
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route pour afficher le formulaire de réinitialisation de mot de passe
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route pour soumettre la demande de réinitialisation de mot de passe
Route::post('update/password', [ResetPasswordController::class, 'reset'])->name('password.update');
