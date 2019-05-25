<?php require('partials/head.php'); ?>

    <div class="board">
    <h1>Gestion des pannes</h1>

    <div class="gestion-pannes">
    <div class="pannes-scroll-list half-length">
        <?php

        foreach ($pannes as $panne) {
            if (is_null($panne->endDate)) { ?>
                <div class="element-pannes-scroll-list">
                    <a href="/user-panne?idPanne=<?= $panne->idPanne ?>">Panne n°<?= $panne->idPanne ?>
                        : <?= $panne->descriptif ?></a> <span class="small-date">(<?= $panne->startDate ?>)</span>
                </div>
            <?php }
        } ?>
    </div>


<?php require('partials/footer.php'); ?>