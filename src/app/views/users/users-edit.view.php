<?php require('partials/head.php'); ?>
    <div class="board">
        <h1>Edition de compte</h1>
        <section>
            <form action="/edit-user" method="POST">
                <label class="half-length">
                    <span>Prénom</span>
                    <input type="text" name="prenom" value="<?= rawurldecode($user->prenom) ?>">
                </label>
                <label class="half-length">
                    <span>Nom</span>
                    <input type="text" name="nom" value="<?= rawurldecode($user->nom) ?>">
                </label>
                <label class="full-length">
                    <span>Email</span>
                    <input type="text" name="email" value="<?= rawurldecode($user->email) ?>">
                </label>
                <label class="full-length">
                    <span>Adresse</span>
                    <input type="text" name="adresse" value="<?= rawurldecode($user->adresse) ?>">
                </label>
                <label class="half-length">
                    <span>Ville</span>
                    <input type="text" name="ville" value="<?= rawurldecode($user->ville) ?>">
                </label>
                <label class="half-length">
                    <span>Code Postal</span>
                    <input type="text" name="code_postal" value="<?= rawurldecode($user->code_postal) ?>">
                </label>
                <label class="full-length">
                    <span>Pays</span>
                    <input type="text" name="pays" value="<?= rawurldecode($user->pays) ?>">
                </label>
                <a style="padding: 5px" class="btn-gray" href="/recuperation/1">Modifier votre mot de passe</a> <br><br>
                <input class="btn-gray" type="submit" value="Editer"> | <a href="/delete-user" onclick="return confirm('Êtes-vous sûr ?')" class="supprimerCapteur">Supprimer le compte</a>
            </form>
        </section>
    </div>

<?php require('partials/footer.php'); ?>