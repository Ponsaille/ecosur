<?php require('partials/head.php'); ?>

    <!-- Image principale avec texte en jumbotron -->
    <figure class="jumbotron" id="home">
        <img src="<?= $modifiables["jumbotron_image"]->contenu ?>" alt="" srcset="">
        <figcaption><?= $modifiables["jumbotron_text"]->contenu ?></figcaption>
    </figure>


    <div class="container">

        <!-- Texte de présentation -->
        <a class="anchor" id="domisep-anchor"></a>
        <section>
            <?= $modifiables["domisep_description"]->contenu ?>
        </section>

        <!-- Produits (image + description) -->
        <a class="anchor" id="products-anchor"></a>
        <section id="products">
            <h2>Produits</h2>
            <div>
                <figure>
                    <img src="<?= $modifiables["produit1_logo"]->contenu ?>" alt="">
                    <hr>
                    <figcaption>
                        <?= $modifiables["produit1_text"]->contenu ?>
                    </figcaption>
                </figure>
                <figure>
                    <img src="<?= $modifiables["produit2_logo"]->contenu ?>" alt="">
                    <hr>
                    <figcaption>
                        <?= $modifiables["produit2_text"]->contenu ?>
                    </figcaption>
                </figure>
                <figure>
                    <img src="<?= $modifiables["produit2_logo"]->contenu ?>" alt="">
                    <hr>
                    <figcaption>
                        <?= $modifiables["produit2_text"]->contenu ?>
                    </figcaption>
                </figure>
            </div>
        </section>

        <!-- Formulaire de contact -->
        <section>
            <a class="anchor" id="contact-anchor"></a>
            <h2>Contact</h2>
            <form method="POST" action="/contact">
                <label class="half-length">
                    <span>Nom</span>
                    <input type="text" name="name">
                </label>
                <label class="half-length">
                    <span>Prénom</span>
                    <input type="text" name="firstname">
                </label>
                <label class="full-length">
                    <span>Courriel</span>
                    <input type="text" name="email">
                </label>
                <label class="full-length">
                    <span>Corps</span>
                    <textarea name="body"></textarea>
                </label>
                <input class="btn-gray" type="submit" value="Envoyer">
            </form>
        </section>
    </div>

<?php require('partials/footer.php'); ?>