<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Pagination\Paginator;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/contacts-and-organisations', function () {
    $contacts = Contact::all();
    $organisations = Organisation::all();
    Paginator::useBootstrap(); // Facultatif : pour utiliser la mise en forme Bootstrap pour la pagination
    return view('contacts_and_organisations', compact('contacts', 'organisations'));
});
Route::get('/contacts-and-organisations/search', [ContactController::class, 'search'])->name('contact.search');
Route::get('/add_modal',[ContactController::class, 'ajouter'])->name('contact.ajouter');
 Route::get('/Contact', [ContactController::class, 'liste_contact']);
// routes/web.php

Route::get('/contacts-and-organisations', function () {
    $contacts = Contact::with('organisation')->simplePaginate(10);
    $organisations = Organisation::all();

    return view('contacts_and_organisations', compact('contacts', 'organisations'));
});
// Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
// // // Définir la route pour afficher le formulaire de modification de contact
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
// Définir la route pour traiter le formulaire de modification de contact (envoi du formulaire)
 Route::get('/contact/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::post('/contact/valid', 'ContactController@valid')->name('contact.valid');
Route::get('/add_modal', 'YourController@addModal')->name('add.modal');


// // // Définir la route pour afficher le formulaire de confirmation de suppression de contact
Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');

// // // Définir la route pour supprimer effectivement le contact (action de suppression)
 Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

// // Définir la route pour supprimer effectivement le contact (action de suppression)
// Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

 Route::get('/contact/show/{id}', [ContactController::class, 'show'])->name('contact.show');
// // // Définir la route pour afficher les détails d'un contact spécifique
Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');
 Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// // web.php

// Route::delete('/contacts/{id}', 'ContactController@destroy')->name('contact.delete');
// Route::delete('/contacts/{id}', 'ContactController@destroy')->name('contact.delete');
Route::get('/contact', [ContactController::class, 'store'])->name('contact.store');
