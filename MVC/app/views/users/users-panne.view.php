<?php require('partials/head.php'); ?>

    <div class="board">
    <h1>Pannes n°<?= $idPanne ?></h1> <button href="/user-sav" class="btn-gray">Retour</button>

    <div class="gestion-pannes">
    <form action="/user-message?idPanne=<?= $idPanne ?>" method="POST">
        <div class="chatbox">
            <div class="chatbox-header">
                <h3>Contact</h3>
            </div>
            <div class="chatbox-body">
                <?php
                foreach ($messages as $message) {
                    if ($message->idPanne == $idPanne) {
                        if ($_SESSION['user_id'] != $message->idPersonne) {
                            ?>
                            <div class="message recu">
                                <p><?= rawurldecode($message->content) ?></p>
                            </div>
                        <?php } else {
                            ?>
                            <div class="message envoye">
                                <p><?= rawurldecode($message->content) ?></p>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <div class="input-message-btn">
                <input class="chatbox-message-input" type="text" name="message">
                <button class="send-button" type='int' name="type"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </form>

    <div class="form-management id-temporaire">
        <h2>Générer un id temporaire</h2>
        <span id="id-tempo-span"></span>
        <button class="btn-gray" id="generate-id-tempo-btn" href="#">Générer</button>
        <script>
            const generateIdTempoBtn = document.getElementById("generate-id-tempo-btn");
            const idTempoSpan = document.getElementById("id-tempo-span");
            generateIdTempoBtn.addEventListener("click", function (e) {
                idTempoSpan.innerText = "Generating...";
                fetch('/generateIdTemporaire')
                    .then(res => res.json())
                    .then(json => {
                        idTempoSpan.innerText = json.idTemporaire;
                    });
            })
        </script>
    </div>





<?php require('partials/footer.php'); ?>