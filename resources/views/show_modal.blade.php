<!doctype html>
<html lang="en">
<head>
    <!-- ... Autres balises meta et CSS ... -->
    <title>AJOUTER UN CONTACT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers la bibliothèque font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- ... Autres balises meta et CSS ... -->
    <style>
        /* Style pour le cadre avec ombre et bordures arrondies */
        .custom-shadow-container {
            padding: 20px; /* Espacement intérieur pour le contenu */
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); Ombre */
            border-radius: 10px; /* Bordures arrondies */
        }

        .validation-error {
            border: 1px solid red;
        }
        .bottom-rectangle {
          background-color: #e3efec;
            /* bottom: 0;
            left: 0; */
            width: 100%;
            padding: 10px 0;
            backdrop-filter: blur(5px); /* Appliquer l'effet de flou */
            z-index: 9999; /* Assurez-vous que le rectangle apparaît au-dessus de tout le contenu */
        }
    </style>
</head>
<body>
<!-- show_modal.blade.php -->


        <div>
        <h5 class="mb-4">Detail de contact</h5>
        <form class="row g-3 needs-validation" action="{{ route('contact.valid') }}" method="POST" novalidate>
                

                <div class="col-md-6">
                    <label for="prénom" class="form-label">Prénom</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('prénom') is-invalid @enderror"
                               id="prénom" name="prénom"
                               value="{{ $contact->nom }}" aria-describedby="inputGroupPrepend" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                               id="nom" name="nom"
                               value="{{ $contact->prenom }}" aria-describedby="inputGroupPrepend" readonly>
                    </div>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ $contact->e_mail }}" aria-describedby="inputGroupPrepend" readonly>
                    </div>
                </div>
                <div class="col-12">
                    <label for="entreprise" class="form-label">Entreprise</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('entreprise') is-invalid @enderror"
                               id="entreprise" name="entreprise"
                               value="{{  $contact->organisation->nom }}" readonly>
                    </div>
                </div>
                <div class="col-12">
                <label for="adresse" class="form-label">Adresse</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">{{  $contact->organisation->ville }}</label>
                </div>
                </div>
                <!-- <div class="col-12">
                    <label for="adresse" class="form-label">Adresse</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror"
                               id="adresse" name="adresse"
                               value="{{  $contact->organisation->ville }}" readonly>
                    </div>
                </div> -->
                <div class="col-md-2">
                    <label for="code_postal" class="form-label">Code postal</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('code_postal') is-invalid @enderror"
                               id="code_postal" name="code_postal"
                               value="{{ $contact->organisation->code_postal }}" readonly>
                    </div>
                </div>
                <div class="col-md-10">
                    <label for="ville" class="form-label">Ville</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('ville') is-invalid @enderror"
                               id="ville" name="ville"
                               value="{{  $contact->organisation->ville }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="statut" class="form-label">Statut</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('entreprise') is-invalid @enderror"
                               id="statut" name="statut"
                               value="{{  $contact->organisation->statut }}" readonly>
                    </div>
                   
                </div>
                
            </form>
        </div>
        
<br>
    <!-- Inclure les librairies JavaScript de jQuery et Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </body>
</html>