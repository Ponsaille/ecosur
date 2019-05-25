<?php use App\Model\Board; ?>


<?php require('partials/head.php'); ?>


    <div class="board">

        <div class="selection">
            <label class="dropButton">
                <select class="dropdown" id="appart-dropdown">
                    <option value="all">All</option>
                    <?php foreach ($ressource as $appart) { ?>
                        <option value="<?= $appart["appartement"]->idDomicile ?>"><?= $appart["appartement"]->Titre ?></option>
                    <?php } ?>
                </select>
                <i class="fas fa-angle-down"></i>
            </label>

            <div class="checkbox-container">
                <label class="custom_checkbox " id="checkboxCapteur">
                    <input class="hidden" type="checkbox" name="checkboxCapteur" checked>
                    <span class="checkbox_span"><i class="fas fa-check"></i></span>
                </label>
                <div class="selectionFleche">Capteurs</div>
            </div>
            <div class="checkbox-container">
                <label class="custom_checkbox" id="checkboxActionneur">
                    <input class="hidden" type="checkbox" name="checkboxActionneur" checked>
                    <span class="checkbox_span"><i class="fas fa-check"></i></span>
                </label>
                <div class="selectionFleche">Actionneurs</div>
            </div>
            <div class="checkbox-container">
                <label class="custom_checkbox" id="checkbox-stats">
                    <input class="hidden" type="checkbox" name="checkbox">
                    <span class="checkbox_span">
                    <i class="fas fa-check"></i>
                </span>
                </label>
                <div class="selectionFleche">Statistiques</div>
            </div>
        </div>

        <?php foreach ($ressource as $appart) { ?>
            <section class="maison" id="appart-<?= $appart["appartement"]->idDomicile ?>">
                <div class="topSection">
                    <div class="topSectionMaison"><?= $appart["appartement"]->Titre ?></div>
                    <div style="color: #45B549" id="chauffage-<?= $appart["appartement"]->idDomicile ?>"
                         class="topSectionIcone"><span>...</span> <i class="fas fa-fire"></i></div>
                    <div style="color: #FFDB0C" id="ampoule-<?= $appart["appartement"]->idDomicile ?>"
                         class="topSectionIcone"><span>...</span> <i class="far fa-lightbulb fa-fw"></i></div>
                </div>
                <article id="stats-<?= $appart["appartement"]->idDomicile ?>" class="stationComplete stats">
                    <canvas style="display: block; margin: 0 auto;" width="600px" height="300px"></canvas>
                </article>

                <?php foreach ($appart["pieces"] as $piece) { ?>

                    <?php foreach ($piece["cemac"] as $cemac) { ?>
                        <article class="stationComplete">
                            <div>
                                <div class="station">
                                    <div><?= "Station #" . $cemac["cemac"]->idCemac ?></div>
                                    <div><?= $piece['piece']->nom ?></div>

                                </div>

                                <?php foreach ($cemac["capteurs"] as $capteur) {
                                    if (!($_SESSION['user_type'] == 1 && in_array($appart["appartement"]->idDomicile, $idHousesWith2ndaryUsers) && $capteur['typeComposant']->icone == "fa-person-booth")) {
                                        ?>
                                        <div class="ligneDescriptionCapteur <?= $capteur["typeComposant"]->type == 1 ? 'actionneur' : 'capteur' ?>">
                                            <?php if ($capteur['typeComposant']->icone == "opened-window") { ?>
                                                <div class="iconeImg"><img src="/public/images/opened-window.png"></div>
                                            <?php } else { ?>
                                                <div class="icone"><i
                                                            class="fas <?= $capteur['typeComposant']->icone ?> fa-fw"></i>
                                                </div>
                                            <?php } ?>
                                            <span class="commentaireIcone"><?= ucfirst($capteur["typeComposant"]->nom) ?></span>
                                            <?php if ($capteur['typeComposant']->type == 1 && !($_SESSION['user_type'] == 1 && in_array($appart["appartement"]->idDomicile, $idHousesWith2ndaryUsers))) { ?>
                                                <div class="interactionCapteur">
                                                    <label class="custom_checkbox2_grey">
                                                        <input class="hidden" type="checkbox" name="checkbox"
                                                               id="checkbox-capteur-<?= $capteur['capteur']->idComposant ?>"
                                                            <?= $capteur['status'] == true ? 'checked' : '' ?>>
                                                        <span class="checkbox2_span_grey"
                                                              onclick="switchCheckbox<?= $capteur['capteur']->idComposant ?>()"></span>
                                                    </label>
                                                </div>

                                                <script>
                                                    function switchCheckbox<?= $capteur['capteur']->idComposant ?>() {
                                                        let checkbox = document.getElementById("checkbox-capteur-<?= $capteur['capteur']->idComposant ?>");
                                                        if (checkbox.checked === false) {
                                                            fetch('/composant/activate?id=<?= $capteur['capteur']->idComposant ?>')
                                                                .then(res => res.json())
                                                                .then(json => {
                                                                    if (json.status === "200") {
                                                                        return checkbox.checked = true
                                                                    }
                                                                });
                                                        } else if (checkbox.checked === true) {
                                                            fetch('/composant/desactivate?id=<?= $capteur['capteur']->idComposant  ?>')
                                                                .then(res => res.json())
                                                                .then(json2 => {
                                                                    if (json2.status === "200") {
                                                                        return checkbox.checked = false
                                                                    }
                                                                });
                                                        }
                                                    }
                                                </script>
                                            <?php } ?>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </article>
                    <?php } ?>
                <?php } ?>
            </section>
        <?php } ?>

    </div>
    <script>
        const appartDropdown = document.getElementById('appart-dropdown');
        const maisons = document.getElementsByClassName('maison');
        appartDropdown.addEventListener('change', function (e) {
            if (e.target.value == "all") {
                for (maison of maisons) {
                    maison.classList.remove('hidden');
                }
            } else {
                for (maison of maisons) {
                    maison.classList.add('hidden');
                }
                console.log(e.target.value)
                document.getElementById(`appart-${e.target.value}`).classList.remove('hidden');
            }
        })

        const checkboxCapteur = document.getElementById('checkboxCapteur');
        const capteurs = document.getElementsByClassName('capteur');

        checkboxCapteur.addEventListener('change', function (e) {
            if (e.target.checked) {
                for (ligneDescriptionCapteur of capteurs) {
                    ligneDescriptionCapteur.classList.remove('hidden');
                    ligneDescriptionCapteur.classList.add('ligneDescriptionCapteur');
                }
            } else {
                for (ligneDescriptionCapteur of capteurs) {
                    ligneDescriptionCapteur.classList.add('hidden');
                    ligneDescriptionCapteur.classList.remove('ligneDescriptionCapteur');
                }
            }
        })

        const checkboxActionneur = document.getElementById('checkboxActionneur');
        const actionneurs = document.getElementsByClassName('actionneur');

        checkboxActionneur.addEventListener('change', function (e) {
            if (e.target.checked) {
                for (ligneDescriptionCapteur of actionneurs) {
                    ligneDescriptionCapteur.classList.remove('hidden');
                    ligneDescriptionCapteur.classList.add('ligneDescriptionCapteur');
                }
            } else {
                for (ligneDescriptionCapteur of actionneurs) {
                    ligneDescriptionCapteur.classList.add('hidden');
                    ligneDescriptionCapteur.classList.remove('ligneDescriptionCapteur');
                }
            }
        })

        const checkboxStats = document.getElementById('checkbox-stats');
        const stats = document.getElementsByClassName('stats');

        checkboxStats.addEventListener('change', function (e) {
            if (e.target.checked) {
                for (stat of stats) {
                    stat.classList.add('stats-active');
                }
            } else {
                for (stat of stats) {
                    stat.classList.remove('stats-active');
                }
            }
        })
    </script>

    <script>

        <?php foreach ($ressource as $appart) { ?>

        const articleStats<?= $appart["appartement"]->idDomicile ?> = document.getElementById('stats-<?= $appart["appartement"]->idDomicile ?>');
        const canvasStats<?= $appart["appartement"]->idDomicile ?> = articleStats<?= $appart["appartement"]->idDomicile ?>.getElementsByTagName('canvas')[0];
        const chauffage<?= $appart["appartement"]->idDomicile ?> = document.getElementById('chauffage-<?= $appart["appartement"]->idDomicile ?>');
        const ampoule<?= $appart["appartement"]->idDomicile ?> = document.getElementById('ampoule-<?= $appart["appartement"]->idDomicile ?>');
        fetch(`/getAppartementStats?id=<?= $appart["appartement"]->idDomicile ?>`)
            .then(res => res.json())
            .then(logs => {
                // Trier par mois
                Object.keys(logs).forEach(idType => {
                    logs[idType] = logs[idType].map(component => {
                        component.logsPerMonths = [];
                        for (let i = 0; i < 12; i++) {
                            component.logsPerMonths[i] = new Array();
                        }
                        const today = new Date();
                        const lastYear = new Date(today.getFullYear() - 1, today.getMonth(), today.getDay());
                        component.logs.forEach(log => {
                            const date = (new Date(log.date))
                            if (date.getTime() > lastYear.getTime()) {
                                const month = date.getMonth();
                                component.logsPerMonths[month].push(log);
                            }
                        })
                        return component;
                    })
                })
                // Ajouter des début et fin si nécessaire pour la calcul
                Object.keys(logs).forEach(idType => {
                    logs[idType] = logs[idType].map(component => {
                        component.logsPerMonths = component.logsPerMonths.map(month => {
                            // Si il est déjà activé au début du mois il faut le mettre désactiver au tout début
                            if (month.length > 0 && month[month.length - 1].active == "0") {
                                const lastDate = new Date(month[month.length - 1].date);
                                const dateStart = new Date(lastDate.getFullYear(), lastDate.getMonth(), 1, 0, 0).toJSON().slice(0, 19).replace('T', ' ');
                                month.push({
                                    idComposant: component.idComposant,
                                    date: dateStart,
                                    active: "1"
                                })
                            }
                            if (month.length > 0 && month[0].active == "1") {
                                const firstDate = new Date(month[month.length - 1].date);
                                const dateEnd = new Date(firstDate.getFullYear(), firstDate.getMonth(), 1, 0, 0).toJSON().slice(0, 19).replace('T', ' ');
                                month.unshift({
                                    idComposant: component.idComposant,
                                    date: dateEnd,
                                    active: "0"
                                })
                            }
                            return month;
                        })
                        return component;
                    })
                });

                // Ramener tout à type
                Object.keys(logs).forEach(idType => {
                    result = [];
                    for (let i = 0; i < 12; i++) {
                        result[i] = new Array();
                    }
                    logs[idType].forEach(component => {
                        component.logsPerMonths.forEach((month, index) => {
                            result[index] = [...result[index], ...month];
                        });
                    })
                    logs[idType] = result
                })

                // Calculer
                Object.keys(logs).forEach(idType => {
                    logs[idType] = logs[idType].map(month => {
                        let result = 0;
                        for (let i = 0; i < month.length; i += 2) {
                            result += ((new Date(month[i].date)).getTime() - (new Date(month[i + 1].date)).getTime()) / 1000 / 3600;
                        }
                        return result;
                    })
                })
                chauffage<?= $appart["appartement"]->idDomicile ?>.getElementsByTagName('span')[0].innerText = logs["2"][(new Date()).getMonth()].toFixed(0) + 'h';
                ampoule<?= $appart["appartement"]->idDomicile ?>.getElementsByTagName('span')[0].innerText = logs["1"][(new Date()).getMonth()].toFixed(0) + 'h';

                let months = ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Dec"]
                for (let i = 0; i < (new Date()).getMonth() + 1; i++) {
                    logs["1"].push(logs["1"].shift());
                    logs["2"].push(logs["2"].shift());
                    months.push(months.shift());
                }
                months = months.reverse();
                drawStats(
                    canvasStats<?= $appart["appartement"]->idDomicile ?>.getContext("2d"),
                    logs["1"].reverse(),
                    logs["2"].reverse(),
                    months
                );


            });
        <?php } ?>
        function drawStats(ctx, values1, values2, xAxis) {
            let values = values1.map((value, index) => {
                return value + values2[index];
            })
            let margin = 10
            let barWidth = ctx.canvas.width / values.length - margin * 2;
            let maxBarHeight = ctx.canvas.height - margin * 2 - 50;
            let max = Math.max(...values);
            values.forEach((value, i) => {
                let ratio = value / max;
                let barHeight = ratio * maxBarHeight; // Calcul de la barre du chauffage
                let littleBarHeight = (values1[i] / max) * maxBarHeight; // Calcul de l'ampoule'
                //Affichage successif des barres
                ctx.fillStyle = "#45B549";
                ctx.fillRect(margin + i * ctx.canvas.width / values.length,
                    ctx.canvas.height - barHeight - 2 - 25,
                    barWidth,
                    barHeight
                );
                if (values2[i] > 0.01) {
                    ctx.fillStyle = "#0D5C14";
                    ctx.font = "12px sans-serif";
                    ctx.textAlign = "center";
                    ctx.fillText(
                        values2[i].toFixed(1) + 'h',
                        i * ctx.canvas.width / values.length + (ctx.canvas.width / values.length) / 2,
                        (ctx.canvas.height - (barHeight + littleBarHeight) / 2 - 2 - 25)
                    );
                }
                ctx.fillStyle = "#FFDB0C";
                ctx.fillRect(margin + i * ctx.canvas.width / values.length,
                    ctx.canvas.height - littleBarHeight - 2 - 25,
                    barWidth,
                    littleBarHeight
                );
                if (values1[i] > 0.01) {
                    ctx.fillStyle = "#A38202";
                    ctx.font = "12px sans-serif";
                    ctx.textAlign = "center";
                    ctx.fillText(
                        values1[i].toFixed(1) + 'h',
                        i * ctx.canvas.width / values.length + (ctx.canvas.width / values.length) / 2,
                        ctx.canvas.height - littleBarHeight / 2 - 2 - 25
                    );
                }
                // Affichage d'une barre par défaut
                ctx.fillStyle = "#FFF";
                ctx.fillRect(margin + i * ctx.canvas.width / values.length,
                    ctx.canvas.height - 2 - 25,
                    barWidth,
                    1
                );
                // Affichage du total
                ctx.font = "12px sans-serif";
                ctx.textAlign = "center";
                ctx.fillText(
                    values[i].toFixed(2) + 'h',
                    i * ctx.canvas.width / values.length + (ctx.canvas.width / values.length) / 2,
                    ctx.canvas.height - barHeight - 2 - 25 - 10
                );
                ctx.fillText(
                    xAxis[i],
                    i * ctx.canvas.width / values.length + (ctx.canvas.width / values.length) / 2,
                    ctx.canvas.height - 10
                );
            })
        }
    </script>


<?php
require('partials/footer.php'); ?>