<?php require('partials/head.php'); ?>

    <div class="board">
    <h1>Pannes n°<?= $idPanne ?></h1> <a href="/sav" class="supprimerCapteur">Retour</a>

    <div class="gestion-pannes">
    <form action="/message?idPanne=<?= $idPanne ?>" method="POST">
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
                <input class="chatbox-message-input" type="text" name="message">
                <button class="send-button" type='int' name="type"><i class="fas fa-paper-plane"></i></button>

            </div>
        </div>
    </form>


    <section>
        <h2>Utiliser l'id temporaire</h2>
        <form action="/useIdTemporaire?idPersonne=<?= $idUser[0]->idPersonne ?>&idPanne=<?= $idPanne ?>" method="POST">
            <label>
                <input type="text" name="idTemporaire">
                <span id="id-tempo-span"></span>
                <button class="btn-gray" id="generate-id-tempo-btn" href="#">Utiliser</button>
            </label>
        </form>
    </section>





<?php require('partials/footer.php'); ?>