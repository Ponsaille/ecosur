<?php require('partials/head.php');
if (!isset($idPanne)) {
    $idPanne = $_GET['idPanne'];
} ?>

    <div class="board">
    <h1>Pannes n°<?= $idPanne ?></h1>
    <button class="btn-gray"><a href="/sav"> Retour </a></button>
    <a href="/end-panne?idPanne=<?= $idPanne ?>" class="supprimerCapteur">   Panne terminée</a>

    <div class="gestion-pannes">
    <form action="" method="POST" id="chatForm">
        <div class="chatbox">
            <div class="chatbox-header">
                <h3>Contact</h3>
            </div>
            <div class="chatbox-body" id="chat">
            </div>
            <div class="input-message-btn">
                <input class="chatbox-message-input" type="text" name="message" placeholder="Tapez votre message ici...">
                <button class="send-button" type='int' name="type" id="msg-btn"><i class="fas fa-paper-plane"></i></button>
            </div>

        </div>
    </form>

    <script>
        function fetchMessages() {
            fetch('/api/messages?idPanne=<?= $idPanne ?>')
                .then(res => res.json())
                .then(json => {
                    const old = chatBody.innerHTML;
                    chatBody.innerHTML = "";
                    json.forEach(message => {
                        let divMsg = document.createElement('div');
                        let paragraph = document.createElement('p');
                        paragraph.innerText = decodeURIComponent(message.content);
                        divMsg.classList.add("message");

                        if (message.idPersonne === "1") {
                            divMsg.classList.add("envoye");
                        } else {
                            divMsg.classList.add("recu");
                        }

                        divMsg.appendChild(paragraph);
                        chatBody.appendChild(divMsg);
                    })
                    if(old != chatBody.innerHTML) {
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }
                }
         )}
        const chatBody = document.getElementById("chat");
        const button = document.getElementById("msg-btn");
        const input = document.getElementById("input-msg");

        setInterval(fetchMessages,500);

        const formulaire = document.getElementById("chatForm");
        formulaire.addEventListener("submit", function (e) {
            let varForm = new FormData(formulaire);
            e.preventDefault();
            fetch('/api/send?idPanne=<?= $idPanne ?>', {
                method: 'POST',
                body: varForm
            }).then(fetchMessages)

            input.value = "";
        });
    </script>

    <?php if(isset($ressource)) {
        ?>
        <?php foreach ($ressource as $appart) { ?>

            <section class="maison" id="appart-<?= $appart["appartement"]->idDomicile ?>">
                <div class="topSection">
                    <div class="topSectionMaison"><?= $appart["appartement"]->Titre ?></div>
                </div>

                <?php foreach ($appart["pieces"] as $piece) { ?>

                    <?php foreach ($piece["cemac"] as $cemac) { ?>
                        <article class="stationComplete">
                            <div>
                                <div class="station">
                                    <div><?= "Station #" . $cemac["cemac"]->idCemac ?></div>
                                    <div><?= $piece['piece']->nom ?></div>
                                </div>

                                <?php foreach ($cemac["capteurs"] as $capteur) { ?>

                                    <div class="ligneDescriptionCapteur <?= $capteur["typeComposant"]->type == 1 ? 'actionneur' : 'capteur' ?>">
                                        <?php if ($capteur['typeComposant']->icone == "opened-window") { ?>
                                            <div class="iconeImg"><img src="/public/images/opened-window.png"></div>
                                        <?php } else { ?>
                                            <div class="icone"><i
                                                        class="fas <?= $capteur['typeComposant']->icone ?> fa-fw"></i>
                                            </div>
                                        <?php } ?>
                                        <span class="commentaireIcone"><?= ucfirst($capteur["typeComposant"]->nom) ?></span>
                                        <?php if ($capteur['typeComposant']->type == 1) { ?>
                                            <div class="interactionCapteur"><label class="custom_checkbox2_grey"><input
                                                            class="hidden" type="checkbox" name="checkbox"><span
                                                            class="checkbox2_span_grey"></span></label></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </article>
                    <?php } ?>

                <?php } ?>

            </section>

        <?php } ?>

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
        </script>

        <?php
    } else {
        ?>
    <div class="form-management id-temporaire">
        <h2>Utiliser l'id temporaire</h2>
        <form action="/useIdTemporaire?idPersonne=<?= $idUser[0]->idPersonne ?>&idPanne=<?= $idPanne ?>" method="POST">
            <label class="use-idTemp">
                <input type="text" name="idTemporaire">
                <span id="id-tempo-span"></span>
                <button class="btn-gray mt-1" id="generate-id-tempo-btn" href="#">Utiliser</button>
            </label>
        </form>
    </div>
        <?php
    }

require('partials/footer.php');