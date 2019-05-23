<?php require('partials/head.php'); ?>

    <div class="board">

        <div class="centered"><h2>Ajouter un lieu</h2></div>
        <form class="full-length form-management" method="POST" action="/new-property">
            <label class="half-length">
                <span>Titre</span>
                <input type="text" name="titre">
            </label>
            <label class="half-length">
                <span>Surface</span>
                <input type="number" name="surface">
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
        <div class="selection property-title mt-3">
            <h2 style="text-decoration: underline"><?= $property->Titre ?></h2>
        </div>
        <form class="full-length form-management" method="POST"
              action="/edit-property?idDomicile=<?= rawurldecode($property->idDomicile) ?>">
            <label class="half-length">
                <span>Titre</span>
                <input type="text" name="Titre" value="<?= rawurldecode($property->Titre) ?>">
            </label>
            <label class="half-length">
                <span>Surface</span>
                <input type="number" name="Surface" value="<?= rawurldecode($property->Surface) ?>">
            </label>
            <label class="half-length">
                <span>Adresse</span>
                <input type="text" name="Adresse" value="<?= rawurldecode($property->Adresse) ?>">
            </label>
            <label class="half-length">
                <span>Ville</span>
                <input type="text" name="Ville" value="<?= rawurldecode($property->Ville) ?>">
            </label>
            <label class="half-length">
                <span>Code Postal</span>
                <input type="text" name="code_postal" value="<?= rawurldecode($property->code_postal) ?>">
            </label>
            <label class="half-length">
                <span>Pays</span>
                <input type="text" name="Pays" value="<?= rawurldecode($property->Pays) ?>">
            </label>
            <input class="btn-gray" type="submit" value="Envoyer">
            <a href="/delete-property?idDomicile=<?= $property->idDomicile ?>">Supprimer</a>
        </form>

        <div class="secondary-user">
            <h3>Ajouter un utilisateur secondaire</h3>
            <form class="full-length" action="/ajoutUtilisateurSecondaire?idDomicile=<?= $property->idDomicile ?>"
                  method="POST">
                <label class="full-length">
                    <span>Email</span>
                    <input type="text" name="email">
                </label>
                <div class="types-composants">
                    <label><span>Aura accès à :</span></label><br>
                    <?php foreach ($typesComposants as $typeComposant) { ?>
                        <div class="content-types">
                            <label class="custom_checkbox checkbox_add_2ndary_user">
                                <input class="hidden" type="checkbox" name="allowedTypes[]"
                                       value="<?= $typeComposant->idtypeComposant; ?>">
                                <?= rawurldecode($typeComposant->nom); ?>
                                <span class="checkbox_span"><i class="fas fa-check"></i></span>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <input class="btn-gray" type="submit" value="Ajouter">
            </form>
        </div>

        <h3>Modifier les pièces de <?= $property->Titre ?></h3>
        <?php foreach ($rooms

        as $room) {
        if (!empty($room)) {
        for ($i = 0;
        $i < count($room);
        $i++) {
        if (($room[$i]->idDomicile == $property->idDomicile)) {
        ?>

        <form class="full-length" method="POST"
              action="/edit-room?idPiece=<?= $room[$i]->idPiece ?>">
            <label class="full-length">
                <input type="text" name="nom" value="<?= $room[$i]->nom ?>">
            </label>
            <input class="btn-gray" type="submit" value="Envoyer">
            <a href="/delete-room?idPiece=<?= $room[$i]->idPiece ?>">Supprimer</a>
        </form>


        <section class="maison">
            <div class="topSection">
                <div class="topSectionMaison">Les stations de la pièces
                    : <?= rawurldecode($room[$i]->nom) ?> | <a href="#" class="supprimerCapteur"
                                                               id="button_capteur_<?= $room[$i]->idPiece ?>">+</a>
                    <div class="overlay" id="station_overlay_<?= $room[$i]->idPiece ?>">
                        <div class="overlay_background overlay_close"></div>
                        <div class="overlay_content">
                            <div class="overlay_header">
                                <i class="fas fa-times overlay_close"></i>
                            </div>
                            <div class="overlay_body">
                                <h3>Ajouter une station</h3>
                                <form class="full-length" method="POST"
                                      action="/new-station?idPiece=<?= $room[$i]->idPiece ?>">
                                    <label class="full-length">
                                        <span>Numéro de station</span>
                                        <input type="number" name="nbObjet" placeholder="Numéro de la station"
                                               maxlength="4">
                                    </label>
                                    <label class="full-length">
                                        <span>Nom</span>
                                        <input type="text" name="Nom" placeholder="Nom de la station">
                                    </label>
                                    <label class="full-length">
                                        <span>Description</span>
                                        <input type="text" name="Descriptif"
                                               placeholder="Description de la station">
                                    </label>
                                    <input class="btn-gray" type="submit" value="Envoyer">
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        const stationOverlay<?= $room[$i]->idPiece ?> = new Overlay(document.getElementById('station_overlay_<?= $room[$i]->idPiece ?>'), document.getElementById('button_capteur_<?= $room[$i]->idPiece ?>'));
                    </script>
                </div>
            </div>
            <?php
            foreach ($cemacs as $cemac) {
                if (!empty($cemac)) {
                    for ($j = 0; $j < count($cemac); $j++) {
                        if ($room[$i]->idPiece == $cemac[$j]->idPiece) {
                            ?>
                            <article>
                                <div class="station">
                                    <div>Station #<?= $cemac[$j]->nbObjet ?> |
                                        <a href="/delete-station?idCemac=<?= $cemac[$j]->idCemac ?>">Supprimer</a>
                                    </div>
                                    <div><?= rawurldecode($cemac[$j]->Nom) ?> </div>
                                </div>
                                <div>
                                    <?php
                                    foreach ($composants as $composant) {
                                        if (!empty($composant)) {
                                            for ($k = 0; $k < count($composant); $k++) {
                                                if ($composant[$k]->idCemac == $cemac[$j]->idCemac) { ?>
                                                    <div class="ligneDescriptionCapteurManagement">
                                                        <div class="icone"><i
                                                                    class="fas <?= $composant[$k]->icone ?> fa-fw"></i>
                                                        </div>
                                                        <a href="/delete-capteur?idComposant=<?= $composant[$k]->idComposant ?>"
                                                           class="supprimerCapteur">Supprimer</a>
                                                    </div>
                                                    <?php

                                                }
                                            }
                                        }
                                    } ?>
                                </div>
                            </article>

                            <div>
                                <article>
                                    <div class="new-capteur">
                                        <a href="#" class="supprimerCapteur "
                                           id="button_capteur_<?= $cemac[$j]->idCemac ?>">
                                            Ajouter un nouveau capteur</a>
                                    </div>
                                </article>
                                <div></div>

                                <div class="overlay" id="capteur_overlay_<?= $cemac[$j]->idCemac ?>">
                                    <div class="overlay_background overlay_close"></div>
                                    <div class="overlay_content">
                                        <div class="overlay_header">
                                            <i class="fas fa-times overlay_close"></i>
                                        </div>
                                        <div class="overlay_body">
                                            <!-- Formulaire de connexion -->
                                            <div class="overlay_body_left">
                                                <h2>Ajouter un capteur</h2>
                                                <form class="full-length"
                                                      action="/new-capteur?idCemac=<?= $cemac[$j]->idCemac ?>"
                                                      method="POST">
                                                    <label class="full-length dropButton">
                                                        <span>Type</span>
                                                        <select class="dropdown" name="nom">
                                                            <?php
                                                            if (isset($typesComposants)) {
                                                                foreach ($typesComposants as $nomTypeComposant) {
                                                                    ?>
                                                                    <option value="<?= $nomTypeComposant->nom ?>"><?= $nomTypeComposant->nom ?></option>
                                                                    <?php
                                                                }
                                                            } ?>
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </label>
                                                    <input class="btn-gray" type="submit" value="Nouveau capteur">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    const capteurOverlay<?= $cemac[$j]->idCemac ?> = new Overlay(document.getElementById('capteur_overlay_<?= $cemac[$j]->idCemac ?>'), document.getElementById('button_capteur_<?= $cemac[$j]->idCemac ?>'));
                                </script>
                            </div>
                        <?php }
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
            <?php } ?>

    </div>

<?php require('partials/footer.php'); ?>