<!DOCTYPE html>
<html lang="en">
<head>
    <title>AJOUTER UN CONTACT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers la bibliothèque font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Style pour le cadre avec ombre et bordures arrondies */
        .custom-shadow-container {
            padding: 20px; /* Espacement intérieur pour le contenu */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre */
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
    <!-- Utiliser la classe personnalisée "table-container" pour ajouter l'ombre au tableau -->
    <div >
        <div >
            <h5 class="mb-4">Ajouter un contact</h5>
            <form class="row g-3 needs-validation" action="{{ route('contact.valid') }}" method="POST" novalidate>
                @csrf

                <div class="col-md-4">
                    <label for="prénom" class="form-label">Prénom</label>
                    <input type="text" class="form-control @error('prénom') is-invalid @enderror"
                           id="prénom" name="prénom" value="{{ old('prénom') }}" aria-describedby="inputGroupPrepend" required>
                    @error('prénom')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror"
                           id="nom" name="nom" value="{{ old('nom') }}" aria-describedby="inputGroupPrepend" required>
                    @error('nom')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" aria-describedby="inputGroupPrepend" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="text" class="form-control @error('fonction') is-invalid @enderror"
                           id="fonction" name="fonction" value="{{ old('fonction') }}" required>
                    @error('fonction')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                           id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                    @error('telephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="service" class="form-label">Service</label>
                    <input type="text" class="form-control @error('service') is-invalid @enderror"
                           id="service" name="service" value="{{ old('service') }}" required>
                    @error('service')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="entreprise" class="form-label">Entreprise</label>
                    <input type="text" class="form-control @error('entreprise') is-invalid @enderror"
                           id="entreprise" name="entreprise" value="{{ old('entreprise') }}" required>
                    @error('entreprise')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select @error('statut') is-invalid @enderror"
                            id="statut" name="statut" required>
                        <option selected disabled value="">Choisir...</option>
                        <option value="LEAD">Lead</option>
                        <option value="CLIENT">Client</option>
                        <option value="PROSPECT">Prospect</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="code_postal" class="form-label">Code postal</label>
                    <input type="text" class="form-control @error('code_postal') is-invalid @enderror"
                           id="code_postal" name="code_postal" value="{{ old('code_postal') }}" required>
                    @error('code_postal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control @error('ville') is-invalid @enderror"
                           id="ville" name="ville" value="{{ old('ville') }}" required>
                    @error('ville')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control @error('adresse') is-invalid @enderror"
                           id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                    @error('adresse')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ... Autres champs de formulaire ... -->
                <div class="bottom-rectangle d-flex justify-content-end" style="width: 120%;">
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Ajouter le contact</button>
                    <a href="/contacts-and-organisations/search" class="btn btn-secondary custom-btn">Annuler</a>
                </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Inclure les librairies JavaScript de jQuery et Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
