<?php require('partials/head.php'); ?>

    <div class="container" style="margin-top: 125px">

        <section id="FAQ">
            <?php foreach ($faqs as $faq) { ?>
                <div class="faq-show">
                    <h1><?= $faq->question ?></h1>
                    <p><?= $faq->reponse ?></p>
                </div>
            <?php } ?>


        </section>

    </div>

<?php require('partials/footer.php'); ?>