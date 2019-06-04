<?php require('partials/head.php'); ?>

    <div class="container" style="margin-top: 175px">

        <section>
            <h2>Changez votre mot de passe :</h2>

            <form class="faq-show" method="POST" action="/recuperation/2?idPersonne=<?= $idPersonne ?>&token=<?= $key ?>">
                <label>
                    <span>Mot de passe :</span>
                    <input type="password" name="password" required>
                </label>
                <input class="btn-gray" type="submit" value="Modifier">
            </form>

        </section>

    </div>

<?php require('partials/footer.php'); ?>