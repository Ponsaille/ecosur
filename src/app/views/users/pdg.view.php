<?php require('partials/head.php'); ?>
    <div class="board">
        <section>
            <h2>Inscription</h2>
            <form action="/pdg/inscription_admin" method="POST">
                <label class="half-length">
                    <span>Prénom</span>
                    <input type="text" name="prenom">
                </label>
                <label class="half-length">
                    <span>Nom</span>
                    <input type="text" name="nom">
                </label>
                <label class="full-length">
                    <span>Email</span>
                    <input type="text" name="email">
                </label>
                <label class="full-length">
                    <span>Adresse</span>
                    <input type="text" name="adresse">
                </label>
                <label class="half-length">
                    <span>Ville</span>
                    <input type="text" name="ville">
                </label>
                <label class="half-length">
                    <span>Code Postal</span>
                    <input type="text" name="code_postal">
                </label>
                <label class="full-length">
                    <span>Pays</span>
                    <input type="text" name="pays">
                </label>
                <label class="full-length">
                    <span>Mot de passe</span>
                    <input type="password" name="password">
                </label>
                <div class="radio-pdg-choice full-length">
                    <label><span class="supprimerCapteur">Choisir son status :</span></label>
                    <label>
                        <input type="radio" name="type" value=0 checked>
                        Utilisateur
                    </label>
                    <label>
                        <input type="radio" name="type" value=1>
                        Gestionnaire
                    </label>
                    <label>
                        <input type="radio" name="type" value=2>
                        Webmaster
                    </label>
                    <label>
                        <input type="radio" name="type" value=3>
                        Collectivité
                    </label>
                    <label>
                        <input type="radio" name="type" value=4>
                        Admin/SAV
                    </label>
                </div>
                <input class="btn-gray mb-3" type="submit" value="Inscrire">
            </form>
        </section>
    </div>
<?php require('partials/footer.php'); ?>