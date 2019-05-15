<?php require('partials/head.php'); ?>

    <!-- <script>
        let changeContent = function (title) {
            //let titleDom = document.getElementById(title);
            let AdresseForm = document.getElementsByName('adresse');
            let villeForm = document.getElementsByName('ville');
            let codePostalForm = document.getElementsByName('code_postal');
            let paysForm = document.getElementsByName('pays');

            <?php if (isset($properties)) {
        foreach ($properties as $property) {
            ?> if (title === "<?= $property->Titre; ?>") {
                AdresseForm.placeholder = "<?= $property->Adresse; ?>";
        }
        <?php
        }
    } ?>


        }
    </script> -->

    <div class="board">

        <div class="selection">
            <h2>Ajouter un lieu</h2>
        </div>
        <form class="full-length form-management" method="POST" action="/new-property">
            <label class="full-length">
                <span>Titre</span>
                <input type="text" name="titre">
            </label>
            <label class="half-length">
                <span>Adresse</span>
                <input type="text" name="adresse">
            </label>
            <label class="half-length">
                <span>Code Postal</span>
                <input type="text" name="code_postal">
            </label>
            <label class="half-length">
                <span>Ville</span>
                <input type="text" name="ville">
            </label>
            <label class="half-length">
                <span>Pays</span>
                <input type="text" name="pays">
            </label>
            <input class="btn-gray" type="submit" value="Envoyer">
        </form>

    </div>

    <div class="board">

        <!-- <div class="selection">
            <h2>Modifier un lieu</h2>
            <label class="dropButton">
                <select id="select-property" class="dropdown"
                onchange="changeContent(this.options[this.selectedIndex].text)">
                <?php
        /*
                if (isset($properties)) {
                    foreach ($properties as $property) {
                        ?>
                        <option><?= $property->Titre ?></option><?php
                    }
                }
        */ ?>
                </select>
                <i class="fas fa-angle-down"></i>
            </label>
        </div> -->

        <?php
        if (isset($properties)) {
            foreach ($properties as $property) {
                ?>
                <h3><?= $property->Titre ?></h3>
                <form class="full-length form-management" method="POST"
                      action="/edit-property?idDomicile=<?= $property->idDomicile ?>">
                    <label class="full-length">
                        <span>Titre</span>
                        <input type="text" name="Titre" value="<?= $property->Titre ?>">
                    </label>
                    <label class="half-length">
                        <span>Adresse</span>
                        <input type="text" name="Adresse" value="<?= $property->Adresse ?>">
                    </label>
                    <label class="half-length">
                        <span>Ville</span>
                        <input type="text" name="Ville" value="<?= $property->Ville ?>">
                    </label>
                    <label class="half-length">
                        <span>Code Postal</span>
                        <input type="text" name="code_postal" value="<?= $property->code_postal ?>">
                    </label>
                    <label class="half-length">
                        <span>Pays</span>
                        <input type="text" name="Pays" value="<?= $property->Pays ?>">
                    </label>
                    <input class="btn-gray" type="submit" value="Envoyer">
                </form>
                <?php
            }
        } ?>


        <!--<form class="full-length form-management" method="POST" action="">
            <label class="full-length">
                <span>Titre</span>
                <input type="text" name="titre" value="">
            </label>
            <label class="half-length">
                <span>Adresse</span>
                <input type="text" name="adresse" value="">
            </label>
            <label class="half-length">
                <span>Ville</span>
                <input type="text" name="ville" value="">
            </label>
            <label class="half-length">
                <span>Code Postal</span>
                <input type="text" name="code_postal" value="">
            </label>
            <label class="half-length">
                <span>Pays</span>
                <input type="text" name="pays" value="">
            </label>
            <input class="btn-gray" type="submit" value="Envoyer">
        </form>-->

        <?php
        if (isset($properties) && isset($rooms) && isset($cemacs)) {
            foreach ($properties as $property) {
                ?>
                <section class="maison">
                    <div class="topSection">
                        <div class="topSectionMaison"><?= $property->Titre ?></div>
                    </div>

                    <?php
                    foreach ($rooms as $room) {
                        foreach ($cemacs as $cemac) {
                            if (($room[0]->idDomicile == $property->idDomicile) && ($room[0]->idPiece == $cemac[0]->idPiece)) {
                                ?>
                                <article>
                                    <div class="station">
                                        <div>Station #<?= $cemac[0]->nbObjet ?> |
                                            <a href="#" class="supprimerCapteur">Supprimer</a>
                                        </div>
                                        <div><?= $room[0]->nom ?></div>
                                    </div>
                                    <div>
                                        <div class="ligneDescriptionCapteurManagement">
                                            <div class="icone"><i class="fas fa-fire fa-fw"></i></div>
                                            <a href="#" class="supprimerCapteur">Supprimer</a>
                                        </div>
                                        <div class="ligneDescriptionCapteurManagement">
                                            <div class="icone"><i class="fas fa-door-closed fa-fw"></i></div>
                                            <a href="#" class="supprimerCapteur">Supprimer</a>
                                        </div>
                                        <div class="ligneDescriptionCapteurManagement">
                                            <div></div>
                                            <a href="#" class="supprimerCapteur">Ajouter un nouveau capteur</a>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
                        }
                    }
                    ?>
                    <article>
                        <div class="station">
                            <a href="#" class="nouvelleStation">Ajouter une nouvelle station</a>
                            <div></div>
                        </div>
                    </article>
                </section>
                <?php
            }
        } ?>

        <!--
        <section class="maison">
            <div class="topSection">
                <div class="topSectionMaison">Maison</div>
            </div>
            <article>
                <div class="station">
                    <div>Station #3644 | <a href="#" class="supprimerCapteur">Supprimer</a></div>
                    <div>Salon</div>
                </div>
                <div>
                    <div class="ligneDescriptionCapteurManagement">
                        <div class="icone"><i class="fas fa-fire fa-fw"></i></div>
                        <a href="#" class="supprimerCapteur">Supprimer</a>
                    </div>
                    <div class="ligneDescriptionCapteurManagement">
                        <div class="icone"><i class="fas fa-door-closed fa-fw"></i></div>
                        <a href="#" class="supprimerCapteur">Supprimer</a>
                    </div>
                    <div class="ligneDescriptionCapteurManagement">
                        <div></div>
                        <a href="#" class="supprimerCapteur">Ajouter un nouveau capteur</a>
                    </div>
                </div>
            </article>
            <article>
                <div class="station">
                    <div>Station #3644 | <a href="#" class="supprimerCapteur">Supprimer</a></div>
                    <div>Chambre</div>
                </div>
                <div class="ligneDescriptionCapteurManagement">
                    <div class="icone"><i class="far fa-lightbulb fa-fw"></i></div>
                    <a href="#" class="supprimerCapteur">Supprimer</a>
                </div>
                <div class="ligneDescriptionCapteurManagement">
                    <div class="iconeImg"><img src="app\views\users\images\opened-window.png"></div>
                    <a href="#" class="supprimerCapteur">Supprimer</a>
                </div>
                <div class="ligneDescriptionCapteurManagement">
                    <div></div>
                    <a href="#" class="supprimerCapteur">Ajouter un nouveau capteur</a>
                </div>
            </article>
            <article>
                <div class="station">
                    <a href="#" class="nouvelleStation">Ajouter une nouvelle station</a>
                    <div></div>
                </div>
            </article>
        </section>
        -->

    </div>

<?php require('partials/footer.php'); ?>