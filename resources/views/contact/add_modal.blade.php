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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre */
            border-radius: 10px; /* Bordures arrondies */
        }
        .validation-error {
            border: 1px solid red;
        }
    </style>
</head>
<body>
<div class="container mt-5 custom-shadow-container">
    <!-- Utiliser la classe personnalisée "table-container" pour ajouter l'ombre au tableau -->
    <div class="container mt-5 p-4 table-container">
        <h5 class="mb-4">Ajouter un contact</h5>

        <div>
            <form class="row g-3 needs-validation" action="{{ route('contact.valid') }}" method="POST" novalidate>
                @csrf
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Prénom</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom01') is-invalid @enderror" id="validationCustom01" name="validationCustom01" value="{{ old('validationCustom01') }}" aria-describedby="inputGroupPrepend" required>
                        @error('validationCustom01')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">Nom</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom02') is-invalid @enderror" id="validationCustom02" name="validationCustom02" value="{{ old('validationCustom02') }}" aria-describedby="inputGroupPrepend" required>
                        @error('validationCustom02')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustomUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <input type="email" class="form-control @error('validationCustomUsername') is-invalid @enderror" id="validationCustomUsername" name="validationCustomUsername" value="{{ old('validationCustomUsername') }}" aria-describedby="inputGroupPrepend" required>
                        @error('validationCustomUsername')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom03" class="form-label">Fonction</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom03') is-invalid @enderror" id="validationCustom03" name="validationCustom03" value="{{ old('validationCustom03') }}" required>
                        @error('validationCustom03')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Tel</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom04') is-invalid @enderror" id="validationCustom04" name="validationCustom04" value="{{ old('validationCustom04') }}" required>
                        @error('validationCustom04')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustomtel" class="form-label">Service</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustomtel') is-invalid @enderror" id="validationCustomtel" name="validationCustomtel" value="{{ old('validationCustomtel') }}" required>
                        @error('validationCustomtel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Entreprise</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom05') is-invalid @enderror" id="validationCustom05" name="validationCustom05" value="{{ old('validationCustom05') }}" required>
                        @error('validationCustom05')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom06" class="form-label">Statut</label>
                    <select class="form-select @error('validationCustom06') is-invalid @enderror" id="validationCustom06" name="validationCustom06" required>
                        <option selected disabled value="">Choisir...</option>
                        <option value="LEAD">Lead</option>
                        <option value="CLIENT">Client</option>
                        <option value="PROSPECT">Prospect</option>
                    </select>
                    @error('validationCustom06')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="validationCustom07" class="form-label">Code postal</label>
                    <input type="text" class="form-control @error('validationCustom07') is-invalid @enderror" id="validationCustom07" name="validationCustom07" value="{{ old('validationCustom07') }}" required>
                    @error('validationCustom07')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="validationCustom08" class="form-label">Ville</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom08') is-invalid @enderror" id="validationCustom08" name="validationCustom08" value="{{ old('validationCustom08') }}" required>
                        @error('validationCustom08')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom09" class="form-label">Adresse</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('validationCustom09') is-invalid @enderror" id="validationCustom09" name="validationCustom09" value="{{ old('validationCustom09') }}" required>
                        @error('validationCustom09')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inclure les librairies JavaScript de jQuery et Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- <script>
    // Validation personnalisée pour le formulaire
    (function () {
        'use strict';
        // Sélectionnez le formulaire
        var form = document.querySelector('.needs-validation');

        // Fonction de validation
        function validateForm(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }

        // Écoutez l'événement de soumission du formulaire et déclenchez la validation
        form.addEventListener('submit', validateForm, false);
    })();
</script> -->
</body>
</html>
