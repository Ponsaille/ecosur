<?php require('partials/head.php'); ?>


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

        <?php
        foreach ($properties

        as $property) {
        ?>
        <div class="selection">
            <h2><?= $property->Titre ?></h2>
        </div>
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

        <h3>Modifier les pièces de <?= $property->Titre ?></h3>
        <?php foreach ($rooms

        as $room) {
        if (!empty($room)) {
        for ($i = 0;
        $i < count($room);
        $i++) {
        if (($room[$i]->idDomicile == $property->idDomicile)) {

        ?>

        <form class="full-length form-management" method="POST"
              action="/edit-room?idPiece=<?= $room[$i]->idPiece ?>">
            <label class="full-length">
                <input type="text" name="nom" value="<?= $room[$i]->nom ?>">
            </label>
            <input class="btn-gray" type="submit" value="Envoyer">
        </form>


        <section class="maison">
            <div class="topSection">
                <div class="topSectionMaison">Les stations de la pièces
                    : <?= $room[$i]->nom ?></div>
            </div>

            <?php
            foreach ($cemacs as $cemac) {
                if (!empty($cemac)) {
                    for ($j = 0; $j < count($cemac); $j++) {
                        if (($room[$i]->idDomicile == $property->idDomicile) && ($room[$i]->idPiece == $cemac[$j]->idPiece)) {
                            ?>
                            <article>
                                <div class="station">
                                    <div>Station #<?= $cemac[$j]->nbObjet ?> |
                                        <a href="#" class="supprimerCapteur">Supprimer</a>
                                    </div>
                                    <div><?= $cemac[$j]->Nom ?> </div>
                                </div>
                                <div>
                                    <div class="ligneDescriptionCapteurManagement">
                                        <div class="icone"><i class="fas fa-fire fa-fw"></i></div>
                                        <a href="#" class="supprimerCapteur">Supprimer</a>
                                    </div>
                                    <div class="ligneDescriptionCapteurManagement">
                                        <div class="icone"><i class="fas fa-door-closed fa-fw"></i>
                                        </div>
                                        <a href="#" class="supprimerCapteur">Supprimer</a>
                                    </div>
                                    <div class="ligneDescriptionCapteurManagement">
                                        <div></div>
                                        <a href="#" class="supprimerCapteur">Ajouter un nouveau
                                            capteur</a>
                                    </div>
                                </div>
                            </article>
                            <?php
                        }
                    }
                }
            }

            }
            }
            }
            }
            ?>


            <form class="full-length form-management" method="POST"
                  action="/new-room?idDomicile=<?= $property->idDomicile ?>">
                <label class="full-length">
                    <input type="text" name="nom" placeholder="Ajouter une nouvelle pièce dans <?= $property->Titre ?>">
                </label>
                <input class="btn-gray" type="submit" value="Envoyer">
            </form>
            <?php

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