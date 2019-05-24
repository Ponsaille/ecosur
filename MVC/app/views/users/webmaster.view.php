<?php require('partials/head.php'); ?>
    <div class="board">
        <h1>Page WebMaster</h1>
        <section>
            <h2 class="mt-3">Eléments modifiables</h2>
            <div class="pannes-scroll-list half-length">
                <?php foreach ($modifiables as $modifiable) { ?>
                    <div class="element-pannes-scroll-list">
                        <a href="/webmaster/modifiables?id=<?= $modifiable->idElementsModifiables ?>"><?= $modifiable->titre ?></a>
                    </div>
                <?php } ?>
            </div>
        </section>
        <section>
            <h2 class="mt-3">Foire aux questions</h2>
            <div class="pannes-scroll-list half-length">
                <?php foreach ($faqs as $faq) { ?>
                    <div class="element-pannes-scroll-list">
                        <a href="/webmaster/faqs?id=<?= $faq->idFAQ ?>"><?= $faq->question ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="form-management id-temporaire faq-new">
                <h3>Nouvelle question pour la FAQ</h3>
                <form action="/webmaster/faqs/add" method="post">
                    <label class="full-length">
                        <span>Question: </span>
                        <input type="text" name="question">
                    </label><br>
                    <label class="full-length">
                        <span>Réponse: </span>
                        <textarea name="reponse"></textarea>
                    </label><br>
                    <input class="btn-gray" type="submit" value="Envoyer">
                </form>
            </div>
        </section>
        <section>
            <h2 class="mt-3">Types de composants</h2>
            <ul>
                <div class="form-management id-temporaire faq-new">
                    <h3>Nouveau type de composant</h3>
                    <form action="/webmaster/typeComposant/add" method="post">
                        <label class="half-length">
                            <span>Nom</span>
                            <input type="text" name="nom">
                        </label>
                        <label class="half-length">
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
                </div>
                <h3>Modifier</h3>
                <?php foreach ($typeComposants as $typeComposant) { ?>
                    <form action="webmaster/typeComposant/edit?id=<?= $typeComposant->idtypeComposant ?>" method="post" class="mt-3 faq-new form-management">
                        <label class="half-length">
                            <span>Nom</span>
                            <input type="text" name="nom" value="<?= $typeComposant->nom ?>">
                        </label>
                        <label class="half-length">
                            <span>Icone</span>
                            <input type="text" name="icone" value="<?= $typeComposant->icone ?>">
                        </label><br>
                        <label class="label-radio">
                            <input type="radio" name="type" value="0" <?= $typeComposant->type == 0 ? "checked" : "" ?>>
                            <div class="radio-type">Capteur</div>
                        </label>
                        <label class="label-radio">
                            <input type="radio" name="type" value="1" <?= $typeComposant->type == 1 ? "checked" : "" ?>>
                            <div class="radio-type">Actionneur</div>
                        </label><br>
                        <input class="btn-gray" type="submit" value="Envoyer"> <a href="">Supprimer</a>
                    </form>
                <?php } ?>
            </ul>
        </section>
    </div>
<?php require('partials/footer.php'); ?>