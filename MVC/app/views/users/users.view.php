<?php use App\Model\Board;?>


<?php require('partials/head.php'); ?>


<div class="board">

    <div class="selection">
        <label class="dropButton">
            <select class="dropdown" id="appart-dropdown">
                <option value="all">All</option>
                <?php foreach($ressource as $appart){ ?>
                        <option value="<?= $appart["appartement"]->idDomicile ?>"><?= $appart["appartement"]->Titre ?></option>
                <?php } ?>
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

    <?php foreach($ressource as $appart){ ?>

    <section class="maison" id="appart-<?= $appart["appartement"]->idDomicile ?>">
        <div class="topSection">
            <div class="topSectionMaison"><?= $appart["appartement"]->Titre ?></div>
            <div class="topSectionIcone">10h30 <i class="fas fa-fire"></i></div>
            <div class="topSectionIcone">24h04 <i class="far fa-lightbulb fa-fw"></i></div>
        </div>

        <?php foreach($appart["pieces"] as $piece){?>
                    
            <?php foreach($piece["cemac"] as $cemac ){ ?>
                <article class="stationComplete">
                    <div>
                        <div class="station">
                            <div><?= "Station #" . $cemac["cemac"]->idCemac ?></div>
                            <div><?= $piece['piece']->nom ?></div>
                        </div>
                    
                        <?php foreach($cemac["capteurs"] as $capteur){?>

                            <div class="ligneDescriptionCapteur <?= $capteur["typeComposant"]->type == 1 ? 'actionneur' : 'capteur' ?>">
                                <?php if ($capteur['typeComposant']->icone == "opened-window"){ ?>
                                    <div class="iconeImg"><img src="/public/images/opened-window.png"></div>
                                <?php } else { ?>
                                    <div class="icone"><i class="fas <?= $capteur['typeComposant']->icone ?> fa-fw"></i></div>
                                <?php } ?>
                                <span class="commentaireIcone"><?= ucfirst($capteur["typeComposant"]->nom) ?></span>
                                <?php if($capteur['typeComposant']->type == 1) { ?>
                                    <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input class="hidden" type="checkbox" name="checkbox"><span class="checkbox2_span_grey"></span></label></div>
                                <?php } ?>
                            </div>
                        <?php }?>
                        </div>    
                </article>  
            <?php } ?>
                 
        <?php } ?>
            
       

        <?php } ?>
        
        <script>
            const appartDropdown = document.getElementById('appart-dropdown');
            const maisons = document.getElementsByClassName('maison');
            appartDropdown.addEventListener('change', function(e) {
                if(e.target.value=="all") {
                    for(maison of maisons) {
                        maison.classList.remove('hidden');
                    }
                } else {
                    for(maison of maisons) {
                        maison.classList.add('hidden');
                    }
                    document.getElementById(`appart-${e.target.value}`).classList.remove('hidden');
                }
            })
        </script>
    </section>
</div>

<?php require('partials/footer.php'); ?>