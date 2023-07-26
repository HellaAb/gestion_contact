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
