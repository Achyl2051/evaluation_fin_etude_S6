<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\DevisController;
use App\Http\Middleware\ClientMiddlewar;


Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'handleRegistration'])->name('register');
    Route::get('/', [UserController::class, 'numLogin'])->name('numLogin');
    Route::post('/numLog', [UserController::class, 'handNumLog'])->name('numLog');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'handleLogin'])->name('login');
});

Route::middleware(ClientMiddlewar::class)->group(function () {
    Route::get('/homeNumLog', [UserController::class, 'home'])->name('home');
    Route::get('/logoutClient', [UserController::class, 'logoutClient'])->name('logoutClient'); 

    Route::prefix('devis')->group(function () {
        Route::get('/listeDevis', [DevisController::class, 'listeDevis'])->name('devis.listeDevis');
        Route::get('/creationDevis', [DevisController::class, 'creationDevis'])->name('devis.creationDevis');
        Route::get('/generatePDF',[DevisController::class,'generatePDF'])->name('devis.generatePDF');
        Route::get('/showDetails',[DevisController::class,'showDetails'])->name('devis.showDetails');
        Route::post('/ajoutDevis', [DevisController::class, 'ajoutDevis'])->name('devis.ajoutDevis');
        Route::post('/mandoaVola', [DevisController::class, 'mandoaVola'])->name('devis.mandoaVola');
    });
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [UserController::class, 'home'])->name('home');

    Route::prefix('rolesPermissions')->group(function () {
        Route::get('/newRole', [RoleController::class, 'newRole'])->name('role.new');
        Route::post('/createRole', [RoleController::class, 'create_role'])->name('role.create');
        Route::get('/listRoles', [RoleController::class, 'getUserRoles'])->name('role.list');
        Route::get('/roleLists', [RoleController::class, 'roleLists'])->name('role.roleLists');
        Route::get('/roleUsers', [RoleController::class, 'roleUsers'])->name('role.roleUsers');
        Route::get('/userRoles/{idUser}', [RoleController::class, 'userRoles'])->name('role.userRoles');
        Route::get('/rolePermissions/{idRole}',[RoleController::class,'rolePermissions'])->name('role.rolePermissions');
        Route::get('/attributPermissionToRole', [RoleController::class, 'attributPermissionToRole'])->name('role.attributPermissionToRole');
        Route::get('/attributRoleUser', [RoleController::class, 'attributRoleUser'])->name('role.attributRoleUser');     
        Route::post('/createPermission', [RoleController::class, 'create_permission'])->name('permission.create');
        Route::post('/attachPermissionToRole', [RoleController::class, 'attach_permission_to_role'])->name('permission.givePermissionToRole');
        Route::post('/attributeRoleToUser', [RoleController::class, 'attribute_role_to_user'])->name('permission.attributeRoleToUser');
        Route::delete('/delete/{idRole}/{idPermission}',[RoleController::class,'supprimerPermission'])->name('role.supprimerPermission');
    });

    Route::prefix('devisBTP')->group(function () {
        Route::get('/listeDevisBTP', [DevisController::class, 'listeDevisBTP'])->name('devisBTP.listeDevisBTP');
        Route::get('/detailDevisEnCours', [DevisController::class, 'detailDevisEnCours'])->name('devisBTP.detailDevisEnCours');
        Route::get('/listeTravaux', [DevisController::class, 'listeTravaux'])->name('devisBTP.listeTravaux');
        Route::get('/updateTravaux', [DevisController::class, 'updateTravaux'])->name('devisBTP.updateTravaux');
        Route::put('/doUpdateTravaux', [DevisController::class, 'doUpdateTravaux'])->name('devisBTP.doUpdateTravaux');
        Route::get('/listeFinition', [DevisController::class, 'listeFinition'])->name('devisBTP.listeFinition');
        Route::get('/updateFinition', [DevisController::class, 'updateFinition'])->name('devisBTP.updateFinition');
        Route::put('/doUpdateFinition', [DevisController::class, 'doUpdateFinition'])->name('devisBTP.doUpdateFinition');
    });

    Route::prefix('csv')->group(function () {
        Route::get('/importDonne', [CsvController::class, 'importDonne'])->name('csv.importDonne');
        Route::get('/importPaiement', [CsvController::class, 'importPaiement'])->name('csv.importPaiement');
        Route::post('/traitement_importationTravauxMaison', [CsvController::class, 'traitement_importationTravauxMaison'])->name('csv.traitement_importationTravauxMaison');
        Route::post('/traitement_importationPaiement', [CsvController::class, 'traitement_importationPaiement'])->name('csv.traitement_importationPaiement');
    });

    Route::get('/dashboard', [DevisController::class, 'dashboard'])->name('dashboard');
    Route::get('/pageDeleteBase', [UserController::class, 'pageDeleteBase'])->name('pageDeleteBase');
    Route::delete('/deleteBase', [UserController::class, 'deleteBase'])->name('deleteBase');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

