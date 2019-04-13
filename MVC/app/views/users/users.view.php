<?php require('partials/head.php'); ?>


<div class="board">

    <div class="selection">
        <label class="dropButton">
            <select class="dropdown">
                <option>Maison</option>
                <option>Appartement</option>
                <option>Maison de vacances</option>
            </select>
            <i class="fas fa-angle-down"></i>
        </label>
        <div>
            <label class="custom_checkbox">
                <input class="hidden" type="checkbox" name="checkbox">
                <span class="checkbox_span"><i class="fas fa-check"></i></span>
            </label>
        </div>
        <div class="selectionFleche">Capteurs</div>
        <div>
            <label class="custom_checkbox"><input class="hidden" type="checkbox" name="checkbox">
                <span class="checkbox_span"><i class="fas fa-check"></i></span>
            </label>
        </div>
        <div class="selectionFleche">Actionneurs</div>
        <div>
            <label class="custom_checkbox"><input class="hidden" type="checkbox" name="checkbox">
                <span class="checkbox_span">
                    <i class="fas fa-check"></i>
                </span>
            </label>
        </div>
        <div class="selectionFleche">Statistiques</div>
    </div>

    <section class="maison">
        <div class="topSection">
            <div class="topSectionMaison">Maison</div>
            <div class="topSectionIcone">10h30 <i class="fas fa-fire"></i></div>
            <div class="topSectionIcone">24h04 <i class="far fa-lightbulb fa-fw"></i></div>
        </div>

        <article>
            <div class="station">
                <div>Station #3644 </div>
                <div>Salon</div>
            </div>
            <div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="fas fa-fire fa-fw"></i></div>
                    <span class="commentaireIcone">Allumée depuis 3h</span>
                    <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input class="hidden" type="checkbox" name="checkbox"><span class="checkbox2_span_grey"></span></label></div>
                </div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="fas fa-door-closed fa-fw"></i></div>
                    <span class="commentaireIcone">Porte fermée</span>
                </div>


            </div>
        </article>

        <article>

            <div class="station">
                <div>Station #3644 </div>
                <div>Chambre</div>
            </div>

            <div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="far fa-lightbulb fa-fw"></i></div>
                    <span class="commentaireIcone">Eteinte</span>
                    <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input class="hidden" type="checkbox" name="checkbox"><span class="checkbox2_span_grey"></span></label></div>
                </div>
                <div class="ligneDescriptionCapteur">
                    <div class="iconeImg"><img src="images/opened-window.png"></div>
                    <span class="commentaireIcone">Fenêtre ouverte</span>
                </div>
            </div>

        </article>

    </section>



    <section class="maison">
        <div class="topSection">
            <div class="topSectionMaison">APPARTEMENT</div>
            <div class="topSectionIcone">10h30 <i class="fas fa-fire"></i></div>
            <div class="topSectionIcone">24h04 <i class="far fa-lightbulb fa-fw"></i></div>
        </div>

        <article>
            <div class="station">
                <div>Station #3644 </div>
                <div>Salon</div>
            </div>
            <div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="fas fa-fire fa-fw"></i></div>
                    <span class="commentaireIcone">Allumée depuis 3h</span>
                    <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input class="hidden" type="checkbox" name="checkbox"><span class="checkbox2_span_grey"></span></label></div>
                </div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="fas fa-door-closed fa-fw"></i></div>
                    <span class="commentaireIcone">Porte fermée</span>
                </div>


            </div>
        </article>

        <article>

            <div class="station">
                <div>Station #3644 </div>
                <div>Chambre</div>
            </div>

            <div>
                <div class="ligneDescriptionCapteur">
                    <div class="icone"><i class="far fa-lightbulb fa-fw"></i></div>
                    <span class="commentaireIcone">Eteinte</span>
                    <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input class="hidden" type="checkbox" name="checkbox"><span class="checkbox2_span_grey"></span></label></div>
                </div>
                <div class="ligneDescriptionCapteur">
                    <div class="iconeImg"><img src="images/opened-window.png"></div>
                    <span class="commentaireIcone">Fenêtre ouverte</span>
                </div>
            </div>

        </article>

    </section>
</div>

<?php require('partials/footer.php'); ?>