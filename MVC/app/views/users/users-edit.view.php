<?php require('partials/head.php'); ?>
    <div class="board">
        <h1>Edition de compte</h1>
        <section>
            <form action="/edit-user" method="POST">
                <label class="half-length">
                    <span>Prénom</span>
                    <input type="text" name="prenom" value="<?= $user->prenom ?>">
                </label>
                <label class="half-length">
                    <span>Nom</span>
                    <input type="text" name="nom" value="<?= $user->nom ?>">
                </label>
                <label class="full-length">
                    <span>Email</span>
                    <input type="text" name="email" value="<?= $user->email ?>">
                </label>
                <label class="full-length">
                    <span>Adresse</span>
                    <input type="text" name="adresse" value="<?= $user->adresse ?>">
                </label>
                <label class="half-length">
                    <span>Ville</span>
                    <input type="text" name="ville" value="<?= $user->ville ?>">
                </label>
                <label class="half-length">
                    <span>Code Postal</span>
                    <input type="text" name="code_postal" value="<?= $user->code_postal ?>">
                </label>
                <label class="full-length">
                    <span>Pays</span>
                    <input type="text" name="pays" value="<?= $user->pays ?>">
                </label>
                <input class="btn-gray" type="submit" value="Editer">
            </form>
        </section>

    </div>
<?php require('partials/footer.php'); ?>