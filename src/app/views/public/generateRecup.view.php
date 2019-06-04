<?php require('partials/head.php'); ?>

    <div class="container" style="margin-top: 175px">

        <section>
            <h2>Récupérez votre mot de passe : </h2>

            <form class="faq-show" method="POST" action="/recuperation/1">
                <label>
                    <span>Email :</span>
                    <input type="email" name="email" required>
                </label>
                <input class="btn-gray" type="submit" value="Générer">
            </form>

        </section>

    </div>

<?php require('partials/footer.php'); ?>