<?php
// Importer les classes et les contrôleurs nécessaires à l'aide de l'instruction "use"
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
| Ici, vous pouvez enregistrer les routes web pour votre application. Toutes ces routes
| seront chargées par le RouteServiceProvider et elles seront toutes attribuées au groupe de middleware "web".
| Faites quelque chose de génial !
|
*/

// Route pour afficher tous les contacts et organisations
Route::get('/contacts-and-organisations', function () {
    // Récupérer tous les contacts et organisations à partir de leurs modèles respectifs
    $contacts = Contact::all();
    $organisations = Organisation::all();
    
    // Facultativement, utiliser le style Bootstrap pour la pagination
    Paginator::useBootstrap();
    
    // Renvoyer la vue 'contacts_and_organisations' et transmettre les variables $contacts et $organisations à la vue
    return view('contacts_and_organisations', compact('contacts', 'organisations'));
});

// Route pour rechercher des contacts en utilisant la méthode 'search' du contrôleur 'ContactController'
Route::get('/contacts-and-organisations/search', [ContactController::class, 'search'])->name('contact.search');

// Route pour afficher la vue 'add_modal' en utilisant la méthode 'ajouter' du contrôleur 'ContactController'
Route::get('/add_modal',[ContactController::class, 'ajouter'])->name('contact.ajouter');

// Route pour afficher la liste des contacts en utilisant la méthode 'liste_contact' du contrôleur 'ContactController'
Route::get('/Contact', [ContactController::class, 'liste_contact']);

// Route pour afficher tous les contacts avec pagination en utilisant le modèle 'Contact' avec son organisation associée
Route::get('/contacts-and-organisations', function () {
    $contacts = Contact::with('organisation')->simplePaginate(10);
    $organisations = Organisation::all();

    return view('contacts_and_organisations', compact('contacts', 'organisations'));
});

// Route pour afficher le formulaire de modification d'un contact en utilisant la méthode 'edit' du contrôleur 'ContactController'
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');

// Route pour traiter le formulaire de modification d'un contact en utilisant la méthode 'update' du contrôleur 'ContactController'
Route::get('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');

// Route pour valider un contact en utilisant la méthode 'valid' du contrôleur 'ContactController'
Route::post('/contact/valid', 'ContactController@valid')->name('contact.valid');

// Route pour afficher la vue 'add_modal' en utilisant la méthode 'addModal' du contrôleur 'YourController'
Route::get('/add_modal', 'YourController@addModal')->name('add.modal');

// Route pour afficher le formulaire de confirmation de suppression d'un contact en utilisant la méthode 'destroy' du contrôleur 'ContactController'
Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');

// Route pour supprimer effectivement un contact en utilisant la méthode 'destroy' du contrôleur 'ContactController'
Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

// Route pour afficher les détails d'un contact spécifique en utilisant la méthode 'show' du contrôleur 'ContactController'
Route::get('/contact/show/{id}', [ContactController::class, 'show'])->name('contact.show');

// Route pour afficher l'index des contacts en utilisant la méthode 'index' du contrôleur 'ContactController'
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Route pour enregistrer un nouveau contact en utilisant la méthode 'store' du contrôleur 'ContactController'
Route::get('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/edit_modal', function () {
    return view('edit_modal');
})->name('edit_modal');

?>