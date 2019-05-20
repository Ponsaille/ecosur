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
    <section>
        <h2>Types de composants</h2>
        <ul>
            <h3>Nouveau:</h3> 
            <form action="webmaster/typeComposant/add" method="post">
                <label>
                    <span>Nom</span>
                    <input type="text" name="nom">
                </label>
                <label>
                    <span>Icone</span>
                    <input type="text" name="icone">
                </label><br>
                <label>
                    <input type="radio" name="type" value="0"> Capteur
                </label>
                <label>
                    <input type="radio" name="type" value="1"> Actionneur
                </label><br>
                <input class="btn-gray" type="submit" value="Envoyer">
            </form>
            <h3>Modifier</h3>
            <?php foreach ($typeComposants as $typeComposant) { ?>
                <form action="webmaster/typeComposant/edit?id=<?= $typeComposant->idtypeComposant ?>" method="post">
                    <label>
                        <span>Nom</span>
                        <input type="text" name="nom" value="<?= $typeComposant->nom ?>">
                    </label>
                    <label>
                        <span>Icone</span>
                        <input type="text" name="icone" value="<?= $typeComposant->icone ?>">
                    </label><br>
                    <label>
                        <input type="radio" name="type" value="0" <?= $typeComposant->type == 0 ? "checked" : "" ?>> Capteur
                    </label>
                    <label>
                        <input type="radio" name="type" value="1" <?= $typeComposant->type == 1 ? "checked" : "" ?>> Actionneur
                    </label><br>
                    <input class="btn-gray" type="submit" value="Envoyer">
                </form>
            <?php } ?>
        </ul>
    </section>
</div>
<?php require('partials/footer.php'); ?>