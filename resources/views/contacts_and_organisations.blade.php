    <!doctype html>
    <html lang="en">
    <head>
        <!-- ... Autres balises meta et CSS ... -->
        <title>LISTE DES CONTCATS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Lien vers la bibliothèque font-awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- ... Autres balises meta et CSS ... -->
        </head>
        <style>
        /* Ajouter une classe personnalisée pour appliquer l'ombre au tableau */
        .table-container {
            background-color: #e3efec;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            font-family: Arial, Helvetica, sans-serif; 
        }

        /* Styles personnalisés pour le champ de recherche */
        .custom-search-input {
            max-width: 400px;
            height: 40px;
        }

        /* Styles personnalisés pour le bouton "Ajouter" */
        .custom-add-button {
            width: 100px;
            height: 40px;
            position: relative; 
            background-color: #2fc9c9;
    ;
        }

        /* Styles personnalisés pour les lignes du tableau */
        .tbody  {
            background-color: #FFFFFF; /* Couleur de fond blanche pour les lignes du tableau */
        }
        .table {
            background-color: #e3efec;
            padding: 15px;
            border-radius: 9px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0.3, 0.3);
        }
        /* Styles personnalisés pour les différents types de statut */
        .statut-LEAD {
            color: #11077a;
            background-color: #4580bf; /* Couleur bleue pour le statut "En cours" */
            border-radius: 9px; /* Bordure bleue */
        }

        .statut-CLIENT {
            color: #115f32;
            background-color: #83e4c8;
            border-radius: 9px; 
        }

        .statut-PROSPECT {
            color: c78770;
            background-color: #c78770; /* Couleur rouge pour le statut "Annulé" */
            border-radius: 10px;
        }
        .crud-icons {
            font-size: 18px;
        }
        /* Style pour l'overlay avec effet de flou */
        /* CSS pour l'overlay avec effet de flou */
        /* CSS pour l'overlay avec effet de flou */
/* Style pour l'overlay avec effet de flou */
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Couleur semi-transparente */
  z-index: 9999; /* Assurez-vous que l'overlay apparaît au-dessus de tout le contenu */
  backdrop-filter: blur(5px); /* Appliquer l'effet de flou */
  display: none; /* Initialement caché */
}
.bottom-rectangle {
    /* Autres styles que vous avez déjà définis pour .bottom-rectangle */
    background-color: rgba(0, 0, 0, 0.5); /* Couleur de fond du div */
    padding: 15px;
}

/* Styles personnalisés pour les boutons */
.bottom-rectangle .btn {
    margin: 5px; /* Ajoute un espace entre les boutons */
    border: none; /* Supprime la bordure par défaut des boutons */
    font-weight: bold; /* Rend le texte des boutons en gras */
    color: gray; /* Couleur du texte des boutons */
    border-radius: 0 0 0 5px;
    border: gray;
}

.bottom-rectangle .btn.btn-primary {
    background-color: #3CBFBF; /* Couleur de fond pour le bouton "Valider" */
}

.bottom-rectangle .btn.btn-secondary {
    background-color: #e3efec;
}


        </style>
    <body>
        <!-- Utiliser la classe personnalisée "table-container" pour ajouter l'ombre au tableau -->
        <div class="container mt-5 p-4 table-container">
        <h5 class="mb-4">Liste des contacts</h5>

        <!-- Formulaire de recherche -->
        <div class="d-flex justify-content-between mb-4">
            <form action="{{ route('contact.search') }}" method="GET" class="input-group">
            <input type="text" name="q" class="form-control custom-search-input" placeholder="Rechercher..." aria-label="Rechercher" aria-describedby="btn-search">
            </form>
            <a href="\add_modal" id="btnAdd" class="btn btn-primary custom-add-button" data-toggle="modal" data-target="#addModal">+ Ajouter</a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th class="sortable-column" data-column="contact.nom" scope="col">NOM DU CONTACT</th>
                <th class="sortable-column" data-column="entreprise.nom" scope="col">SOCIÉTÉ</th>
                <th class="sortable-column" data-column="entreprise.statut" scope="col">STATUT</th>
                <th scope="col"></th>
            </tr>

            </thead>
            <tbody class="tbody">
            @foreach ($contacts as $contact)
                <tr>
                <td>{{ $contact->prenom }} {{ $contact->nom }}</td>
                <td>{{ $contact->organisation->nom }}</td>
                <td><!-- Appliquer la classe de statut appropriée en fonction du type de statut -->
                    @if ($contact->organisation->statut === 'LEAD')
                    <span class="statut-LEAD">{{ ucfirst(strtolower($contact->organisation->statut)) }}</span>
                    @elseif ($contact->organisation->statut === 'CLIENT')
                    <span class="statut-CLIENT">{{ ucfirst(strtolower($contact->organisation->statut)) }}</span>
                    @elseif ($contact->organisation->statut === 'PROSPECT')
                    <span class="statut-PROSPECT">{{ ucfirst(strtolower($contact->organisation->statut)) }}</span>
                    @else
                    {{ $contact->organisation->statut }}
                    @endif
                </td>
                <td>
                        <!-- Colonne contenant les icônes CRUD -->
                        <div class="d-flex justify-content-between crud-icons">
                        <!-- Icônes pour les opérations CRUD -->
                        <a href="" id="btnedit"><i class="fa fa-edit mr-1 text-secondary"></i></a>
                        <a href=""><i class="fa fa-trash mr-1 text-danger"></i></a>
                        <a href="{{ route('contact.show', ['id' => $contact->id]) }}" class="btn-show"><i class="fa fa-eye text-secondary"></i></a>
                       
                        </div>
                    </td>
                    <!-- Inclure la modal d'édition -->
                    @include('edit_modal')
                </tr>
            @endforeach
           
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
                <ul class="pagination pagination-sm"> <!-- Utilisez pagination-lg pour une taille plus grande -->
                    {{ $contacts->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
        
<!-- Modal pour afficher le contenu de la page \add_modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                  
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenu de la page add_modal.blade.php chargé ici -->
                @include('add_modal')
            </div>
        </div>
    </div>
</div>
<!-- Modal pour afficher le contenu de la page \show_modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content d-flex justify-content-end">
            <div class="modal-body">
                <!-- Contenu de la page show_modal.blade.php chargé ici -->
                @include('show_modal')
                
            </div>
            <div class="bottom-rectangle">
                <div class="col-12 d-flex justify-content-end">
                    <a href="/contacts-and-organisations/search" class="btn btn-secondary mr-2">Annuler</a>
                    <button class="btn btn-primary ml-2" type="submit">Valider</button>
                </div>
            </div>

        </div>
    </div>
</div>



<<!-- Script JavaScript -->
<script>
    // Récupérer l'élément du contenu de la page
    const contentDiv = document.getElementById('addModalContent');

    // Ajouter un gestionnaire d'événement pour le clic sur le bouton "Ajouter"
    const addButton = document.getElementById('btnAdd');
    addButton.addEventListener('click', function (event) {
        // Empêcher le comportement par défaut du bouton pour éviter la redirection
        event.preventDefault();

        // Afficher la modal
        $('#addModal').modal('show');

        // Charger le contenu de la page "\add_modal" en utilisant AJAX
        $.ajax({
            url: '/add_modal', // Remplacez l'URL par l'URL correcte pour accéder à la page "\add_modal"
            type: 'GET',
            success: function (data) {
                // Insérer le contenu de la page dans le div "addModalContent"
                contentDiv.innerHTML = data;
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });



    $(document).ready(function() {
        $('.sortable-column').click(function() {
            // Récupérer la colonne sur laquelle on a cliqué
            var column = $(this).data('column');
            
            // Vérifier si la colonne est déjà en cours de tri ascendant ou descendant
            var currentSortOrder = $(this).hasClass('asc') ? 'desc' : 'asc';
            
            // Supprimer les classes "asc" et "desc" de tous les en-têtes de colonnes
            $('.sortable-column').removeClass('asc desc');
            
            // Ajouter la classe appropriée pour indiquer le tri en cours
            $(this).addClass(currentSortOrder);
            
            // Fonction de tri personnalisée (vous devez adapter cela à votre cas d'utilisation)
            sortTable(column, currentSortOrder);
        });
    });
    // Récupérer tous les éléments du bouton "eye" par leur classe
const showButtons = document.querySelectorAll('.btn-show');

// Ajouter un gestionnaire d'événements pour chaque bouton "eye"
showButtons.forEach(showButton => {
    showButton.addEventListener('click', function (event) {
        event.preventDefault();

        // Afficher la modal "showModal"
        $('#showModal').modal('show');

        // Charger le contenu de la page "show_modal" en utilisant AJAX
        $.ajax({
            url: '/show_modal', // Remplacez l'URL par l'URL correcte pour accéder à la page "show_modal"
            type: 'GET',
            success: function (data) {
                // Insérer le contenu de la page dans le div "showModalContent"
                const showModalContent = document.getElementById('showModalContent');
                showModalContent.innerHTML = data;
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});


</script>


     <!-- Inclure les librairies JavaScript de jQuery et Bootstrap -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="{{ asset('js/scripts.js') }}"></script> -->
</body>
    </html>
