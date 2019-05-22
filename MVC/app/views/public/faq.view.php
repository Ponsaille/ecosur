<?php require('partials/head.php'); ?>

    <div class="container" style="margin-top: 125px">

        <section id="FAQ">
            <?php foreach ($faqs as $faq) { ?>
                
                <h2><?= $faq->question ?></h2>
                <p><?= $faq->question ?></p>

            <?php } ?>
            
            
        </section>

    </div>

<?php require('partials/footer.php'); ?>