<?php require('partials/head.php'); ?>
<div class="board">
    <h1>Page WebMaster</h1>
    <section>
        <h2>Eléments modifiables</h2>
        <ul>
            <?php foreach ($modifiables as $modifiable) { ?>
                <li><a href="webmaster/modifiables?id=<?= $modifiable->idElementsModifiables ?>"><?= $modifiable->titre ?></a></li>
            <?php } ?>
        </ul>
    </section>
</div>
<?php require('partials/footer.php'); ?>