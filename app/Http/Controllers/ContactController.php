<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Organisation;

class ContactController extends Controller
{
    public function liste_contact(){
        return view('contact.liste');
    }
    public function index()
    {
        $contacts = Contact::with('organisation')->post();
        $organisations = Organisation::all();

        return view('contacts_and_organisations', compact('contacts', 'organisations'));
    }
    public function search(Request $request)
        {
            $searchTerm = $request->input('q');
            $contacts = Contact::with('organisation')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('nom', 'like', '%' . $searchTerm . '%')
                        ->orWhere('prenom', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('organisation', function ($query) use ($searchTerm) {
                            $query->where('nom', 'like', '%' . $searchTerm . '%');
                        });
                })
                ->paginate(10); // Remplacez 10 par le nombre de résultats par page que vous souhaitez afficher

            $organisations = Organisation::all();

            return view('contacts_and_organisations', compact('contacts', 'organisations'));
        }
        public function ajouter(){
            return view('add_modal');
        }
        public function valid(Request $request)
        {
    // Définir les règles de validation pour chaque champ
    $rules = [
        'prénom' => 'required|alpha', // Prénom (uniquement des lettres, obligatoire)
        'nom' => 'required|alpha', // Nom (uniquement des lettres, obligatoire)
        'email' => 'required|email', // Email (format e-mail valide, obligatoire)
        'fonction' => 'required', // Fonction (obligatoire)
        'telephone' => 'required|numeric', // Tel (uniquement des chiffres, obligatoire)
        'service' => 'required', // Service (obligatoire)
        'entreprise' => 'required|alpha_num', // Entreprise (uniquement des lettres ou des chiffres, obligatoire)
        'statut' => 'required', // Statut (obligatoire)
        'code_postal' => 'required|numeric', // Code postal (uniquement des chiffres, obligatoire)
        'ville' => 'required', // Ville (obligatoire)
        'adresse' => 'required', // Adresse (obligatoire)
    ];

    // Messages d'erreur personnalisés
    $messages = [
        'required' => 'Le champ :attribute est obligatoire.',
        'alpha' => 'Le champ :attribute ne doit contenir que des lettres.',
        'alpha_num' => 'Le champ :attribute ne doit contenir que des lettres ou des chiffres.',
        'email' => 'Le champ :attribute doit être un format d\'e-mail valide.',
        'numeric' => 'Le champ :attribute ne doit contenir que des chiffres.',
    ];

    // Valider les données du formulaire avec les règles et messages personnalisés
    $validator = Validator::make($request->all(), $rules, $messages);

 


    // Rediriger vers le formulaire avec les erreurs de validation si la validation échoue
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }



        // Vérifier si le contact existe déjà (même prénom et même nom)
        $existingContact = Contact::where('prenom', ucwords($rules['prenom']))
        ->where('nom', ucwords($rules['nom']))
        ->first();

    if ($existingContact) {
    // Le contact existe déjà, afficher une modal d'alerte
    // Vous pouvez rediriger vers la vue contenant la modal ou retourner une réponse JSON pour gérer cela côté client
    return response()->json(['message' => 'Le contact existe déjà.'], 422);
    }

    // Vérifier si l'entreprise existe déjà (même nom)
    $existingEntreprise = organisation::where('nom', ucwords($rules['entreprise']))
            ->first();

    if ($existingEntreprise) {
    // L'entreprise existe déjà, afficher une modal d'alerte
    // Vous pouvez rediriger vers la vue contenant la modal ou retourner une réponse JSON pour gérer cela côté client
    return response()->json(['message' => 'L\'entreprise existe déjà.'], 422);
    }
    // Si la validation réussit, traiter les données du formulaire ici
    

    
    
    // Créer un nouvel enregistrement dans la table "organisation"
    $organisation = new Organisation();
    $organisation->nom = ucwords($request->input('entreprise'));
    $organisation->statut = $request->input('statut');
    $organisation->ville = ucwords($request->input('ville'));
    $organisation->adresse = $request->input('adresse');
    $organisation->code_postal = $request->input('code_postal');
    $organisation->cle = $request->input('service');
    $organisation->save();

    $contact = new Contact();
    $contact->prenom = ucwords($request->input('prénom'));
    $contact->nom = ucwords($request->input('nom'));
    $contact->e_mail = strtolower($request->input('email'));
    $contact->fonction = $request->input('fonction');
    $contact->telephone_fixe = $request->input('telephone');
    $contact->cle = $request->input('service');
    $contact->service = $request->input('service');
    $contact->organisation_id=111;
    $contact->save();

    // Associer l'organisation au contact en établissant la relation
    $contact->organisation()->associate($organisation);
    $contact->save();

    // Rediriger vers une page de succès ou une autre action
    return redirect()->route('success.page');
}
//         public function confirmDelete($id)
//     {
//         // Récupérer le contact correspondant à l'ID depuis la base de données
//         $contact = Contact::find($id);

//         // Vérifier si le contact existe
//         if (!$contact) {
//             // Gérer l'erreur si le contact n'est pas trouvé (par exemple, rediriger vers une page d'erreur)
//         }

//         // Afficher la vue du formulaire de confirmation de suppression avec le contact
//         return view('confirm-delete', compact('contact'));
//     }
//     public function destroy($id)
//     {
//         // Trouver le contact en fonction de son ID
//         $contact = Contact::findOrFail($id);

//         // Supprimer le contact
//         $contact->delete();

//         // Rediriger vers la page d'index des contacts avec un message de succès
//         return redirect()->route('contact.index')->with('success', 'Le contact a été supprimé avec succès.');
//     }
 public function destroy($id)
 {
     // Rechercher le contact par son ID
     $contact = Contact::findOrFail($id);
 
     // Supprimer le contact
     $contact->delete();
 
     // Rediriger vers la liste des contacts avec un message de confirmation
     return redirect()->route('contact.index')->with('success', 'Le contact a été supprimé avec succès.');
 }
    public function edit($id)
    {
        // Rechercher le contact par son ID
        $contact = Contact::findOrFail($id);

        // Récupérer les données de l'entreprise associée au contact
        $entreprise = $contact->organisation;

        // Passer les données du contact et de l'entreprise à la vue pour les afficher dans la modal
        return view('edit_modal', compact('contact', 'entreprise'));
    }
        public function update(Request $request, $id)
        {
            
            // // Rechercher le contact par son ID
            $contact = Contact::findOrFail($id);
            
            // Récupérer les données de l'entreprise associée au contact
            $entreprise = $contact->organisation;

            // Mettre à jour les données du contact avec les nouvelles valeurs du formulaire
            $contact->prenom = $request->input('prenom');
            $contact->nom = $request->input('nom');
            $contact->save();

            // Mettre à jour les données de l'entreprise avec les nouvelles valeurs du formulaire
            $entreprise->nom = $request->input('entreprise');
            $entreprise->statut = $request->input('statut');
            $entreprise->save();

            // Rediriger vers la liste des contacts avec un message de confirmation
            return redirect()->route('contact.index')->with('success', 'Les données ont été mises à jour avec succès.');
        }
        public function show($id)
    {
        // Rechercher le contact par son ID
        $contact = Contact::findOrFail($id);

        // Charger la vue de la modal de visualisation avec les données du contact
        return view('show_modal', compact('contact'));
    }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'entreprise' => 'required',
            'statut' => 'required',
        ]);

        // Créer une nouvelle entreprise
        $entreprise = new Organisation;
        $entreprise->nom = $request->input('entreprise');
        $entreprise->statut = $request->input('statut');
        $entreprise->save();

        // Créer un nouveau contact associé à l'entreprise
        $contact = new Contact;
        $contact->prenom = $request->input('prenom');
        $contact->nom = $request->input('nom');
        $contact->organisation_id = $entreprise->id; // Associer le contact à l'entreprise
        $contact->save();

        // Rediriger vers la liste des contacts avec un message de confirmation
        return redirect()->route('contact.index')->with('success', 'Le contact a été ajouté avec succès.');
    }
}