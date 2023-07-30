<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES CONTACTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            background-color: #4ccebc !important;
        }

        /* Styles personnalisés pour les lignes du tableau */
        .tbody {
            background-color: #FFFFFF;
        }

        .table {
            background-color: #e3efec;
            padding: 15px;
            border-radius: 9px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3, 0.3);
        }

        /* Styles personnalisés pour les différents types de statut */
        .statut-LEAD {
            color: #11077a;
            background-color: #4580bf;
            border-radius: 9px;
        }

        .statut-CLIENT {
            color: #115f32;
            background-color: #83e4c8;
            border-radius: 9px;
        }

        .statut-PROSPECT {
            color: c78770;
            background-color: #c78770;
            border-radius: 10px;
        }

        .crud-icons {
            font-size: 18px;
        }

        /* Style pour l'overlay avec effet de flou */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            backdrop-filter: blur(5px);
            display: none;
        }

        .bottom-rectangle {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 15px;
        }

        /* Styles personnalisés pour les boutons */
        .bottom-rectangle .btn {
            margin: 5px;
            border: none;
            font-weight: bold;
            color: gray;
            border-radius: 0 0 0 5px;
            border: gray;
        }

        .bottom-rectangle .btn.btn-primary {
            background-color: #3CBFBF;
        }

        .bottom-rectangle .btn.btn-secondary {
            background-color: #e3efec;
        }

        .modal-header {
            border-bottom: none;
        }
    </style>
</head>

<body>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <!-- Utiliser la classe personnalisée "table-container" pour ajouter l'ombre au tableau -->
    <div class="container mt-5 p-4 table-container">
        <h5 class="mb-4">Liste des contacts</h5>
        <!-- Formulaire de recherche -->
        <div class="d-flex justify-content-between mb-4">
            <form action="{{ route('contact.search') }}" method="GET" class="input-group">
                <input type="text" name="q" class="form-control custom-search-input" placeholder="Rechercher..."
                    aria-label="Rechercher" aria-describedby="btn-search">
            </form>
            <a href="\add_modal" id="btnAdd" class="btn btn-primary custom-add-button" data-toggle="modal"
                data-target="#addModal">+ Ajouter</a>
        </div>
        <table class="table" id="contacts-table">
            <thead>
                <tr>
                    <th class="sortable-column" data-column="contact.nom" scope="col" onclick="sortTable(0)">NOM DU
                        CONTACT</th>
                    <th class="sortable-column" data-column="entreprise.nom" scope="col" onclick="sortTable(1)">SOCIÉTÉ
                    </th>
                    <th class="sortable-column" data-column="entreprise.statut" scope="col" onclick="sortTable(2)">STATUT
                    </th>
                    <th scope="col"></th>
                </tr>

            </thead>
            <tbody class="tbody">
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->prenom }} {{ $contact->nom }}</td>
                    <td>{{ $contact->organisation->nom }}</td>
                    <td>
                        <!-- Appliquer la classe de statut appropriée en fonction du type de statut -->
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
                            <a href="{{ route('contact.edit', ['id' => $contact->id]) }}" class="btn-edit" data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-edit mr-1 text-secondary"></i>
                            </a>

                            <!-- Ajoutez une classe unique "delete-icon" pour chaque icône de corbeille -->
                            <a href="{{ route('contact.delete', ['id' => $contact->id]) }}" class="delete-icon"
                                data-contact-id="{{ $contact->id }}"><i class="fas fa-trash"
                                    style="color: red;"></i></a>
                            <a href="{{ route('contact.show', ['id' => $contact->id]) }}" class="btn-show" data-contact-id="{{ $contact->id }}">
                                    <i class="fa fa-eye text-secondary"></i>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <ul class="pagination pagination-sm">
                <!-- Utilisez pagination-lg pour une taille plus grande -->
                {{ $contacts->render('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>

    <!-- Modal pour afficher le contenu de la page \add_modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div id="addModalContent">
                    <!-- Contenu de la page add_modal.blade.php chargé ici -->
                    @include('add_modal')
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal pour afficher le contenu de la page \show_modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content d-flex justify-content-end">
                <div class="modal-body">
                    <!-- Contenu de la page show_modal.blade.php chargé ici -->
                <div id="showModalContent">
                    @include('show_modal')
                </div>
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
    <!-- Modal de de consultation d'un contact -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content d-flex justify-content-end">
            <div class="modal-body">
                <!-- Contenu de la page edit_modal.blade.php chargé ici -->
                <div id="editModalContent">
                @include('edit_modal')
                </div>
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

    <!-- Modal de confirmation de suppression -->
    @foreach ($contacts as $contact)
    <div class="modal fade" id="confirmDeleteModal-{{ $contact->id }}" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="fas fa-exclamation-circle mr-2" style="color: red;"></i> Supprimer le contact
                    </h5>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce contact ?<br>
                    Cette opération est irréversible.
                </div>
                <div class="bottom-rectangle">
                    <div class="col-12 d-flex justify-content-end">
                    <a href="/contacts-and-organisations/search" class="btn btn-secondary mr-2">Annuler</a>
                        <a href="{{ route('contact.destroy', ['id' => $contact->id]) }}" id="confirmDeleteButton"
                            class="btn btn-danger ml-2">Confirmer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    

    <!-- Inclure les librairies JavaScript de jQuery et Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Récupérer tous les éléments de l'icône de corbeille en utilisant la classe unique "delete-icon"
        var deleteIcons = document.querySelectorAll('a.delete-icon');
        // Parcourir tous les icônes de corbeille et ajouter un gestionnaire d'événement de clic à chacun
        deleteIcons.forEach(function(icon) {
            icon.addEventListener('click', function(event) {
                event.preventDefault();
                // Récupérer l'URL pour la suppression du contact en utilisant l'attribut "href" de l'icône de corbeille
                var deleteUrl = icon.getAttribute('href');
                // Modifier l'attribut "href" du bouton de suppression dans la modal pour l'URL de suppression du contact
                var confirmDeleteButton = document.getElementById('confirmDeleteButton');
                confirmDeleteButton.setAttribute('href', deleteUrl);
                // Ouvrir la modal de confirmation de suppression
                $('#confirmDeleteModal-' + icon.dataset.contactId).modal('show');
            });
        });

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

        const showButtons = document.querySelectorAll('.btn-show');

// Ajouter un gestionnaire d'événements pour chaque bouton "Show"
showButtons.forEach(showButton => {
    showButton.addEventListener('click', function (event) {
        event.preventDefault();

        // Récupérer l'ID du contact à partir de l'attribut data-contact-id du bouton "Show"
        const contactId = showButton.dataset.contactId;

        // Envoyer une requête AJAX pour récupérer les détails du contact
        $.ajax({
            url: '/contact/show/' + contactId, // Remplacez l'URL par l'URL correcte pour récupérer les détails du contact
            type: 'GET',
            success: function (data) {
                // Mettre à jour le contenu de la fenêtre modale avec les détails du contact
                const showModalContent = document.getElementById('showModalContent');
                showModalContent.innerHTML = data;

                // Afficher la fenêtre modale
                $('#showModal').modal('show');
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});

  // Attendez que le document soit prêt
  $(document).ready(function () {
        // Récupérer tous les éléments du bouton "eye" par leur classe
        const editButtons = document.querySelectorAll('.btn-edit');

        // Ajouter un gestionnaire d'événements pour chaque bouton "eye"
        editButtons.forEach(editButton => {
            editButton.addEventListener('click', function (event) {
                event.preventDefault();

                // Afficher la modal "editModal"
                $('#editModal').modal('show');

                // Charger le contenu de la page "edit_modal" en utilisant AJAX
                $.ajax({
                    url: '/edit_modal', // Remplacez l'URL par l'URL correcte pour accéder à la page "edit_modal"
                    type: 'GET',
                    success: function (data) {
                        // Insérer le contenu de la page dans le div "editModalContent"
                        const editModalContent = document.getElementById('editModalContent');
                        editModalContent.innerHTML = data;
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    });


        let sortColumn = -1; // Variable pour garder en mémoire la colonne de tri
        let sortOrder = 1; // Variable pour garder en mémoire l'ordre de tri (1 pour ascendant, -1 pour descendant)

        function sortTable(columnIndex, currentSortOrder) {
            const table = document.getElementById('contacts-table');
            const rows = Array.from(table.getElementsByTagName('tr'));
            const isHeader = rows[0].getElementsByTagName('th').length > 0;

            // Si le clic est effectué sur l'en-tête, on trie les données
            if (isHeader) {
                const dataRows = rows.slice(1); // Exclure la première ligne (en-tête)

                // Vérifier si on clique sur la même colonne
                if (sortColumn === columnIndex) {
                    sortOrder *= -1; // Inverser l'ordre de tri si on clique à nouveau sur la même colonne
                } else {
                    sortColumn = columnIndex; // Mettre à jour la colonne de tri
                    sortOrder = 1; // Réinitialiser l'ordre de tri à ascendant
                }

                // Trier les lignes en fonction de la colonne et de l'ordre de tri
                dataRows.sort((a, b) => {
                    const cellA = a.getElementsByTagName('td')[columnIndex].textContent;
                    const cellB = b.getElementsByTagName('td')[columnIndex].textContent;
                    return sortOrder * cellA.localeCompare(cellB, undefined, { sensitivity: 'base' });
                });

                // Réorganiser les lignes dans le tableau
                dataRows.forEach((row, index) => {
                    table.tBodies[0].appendChild(row);
                });
            }
        }

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
    </script>
</body>

</html>
