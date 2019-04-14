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

    <div class="selection">
        <h2>Modifier un lieu</h2>
        <label class="dropButton">
            <select class="dropdown">
                <option>Maison</option>
                <option>Appartement</option>
                <option>Maison de vacances</option>
            </select>
            <i class="fas fa-angle-down"></i>
        </label>
    </div>
    <form class="full-length form-management" method="POST" action="">
        <label class="full-length">
            <span>Titre</span>
            <input type="text" name="titre">
        </label>
        <label class="half-length">
            <span>Adresse</span>
            <input type="text" name="adresse">
        </label>
        <label class="half-length">
            <span>Ville</span>
            <input type="text" name="ville">
        </label>
        <label class="half-length">
            <span>Code Postal</span>
            <input type="text" name="codePostal">
        </label>
        <label class="half-length">
            <span>Pays</span>
            <input type="text" name="pays">
        </label>
        <input class="btn-gray" type="submit" value="Envoyer">
    </form>

    <section class="maison">
        <div class="topSection">
            <div class="topSectionMaison">Maison</div>
        </div>
        <article>
            <div class="station">
                <div>Station #3644 | <a href="#" class="supprimerCapteur">Supprimer</a> </div>
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
                <div>Station #3644 | <a href="#" class="supprimerCapteur">Supprimer</a> </div>
                <div>Chambre</div>
            </div>
            <div class="ligneDescriptionCapteurManagement">
                <div class="icone"><i class="far fa-lightbulb fa-fw"></i></div>
                <a href="#" class="supprimerCapteur">Supprimer</a>
            </div>
            <div class="ligneDescriptionCapteurManagement">
                <div class="iconeImg"><img src="MVC\app\views\users\images\opened-window.png"></div>
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


</div>

<?php require('partials/footer.php'); ?>