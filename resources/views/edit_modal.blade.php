<!-- edit_modal.blade.php -->

<div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">Édition du contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Afficher les données du contact et de l'entreprise dans un formulaire d'édition -->
                <form action="{{ route('contact.update', ['id' => $contact->id]) }}" method="POST">
                    @csrf
                    @method('put')

                    <!-- Champs pour les données du contact -->
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ $contact->prenom }}">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ $contact->nom }}">
                    </div>

                    <!-- Champs pour les données de l'entreprise associée au contact -->
                    <div class="form-group">
                        <label for="entreprise">Entreprise</label>
                        <input type="text" name="entreprise" class="form-control" value="{{ $contact->organisation->nom }}">
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut de l'entreprise</label>
                        <input type="text" name="statut" class="form-control" value="{{ $contact->organisation->statut }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
