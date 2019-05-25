<?php require('partials/head.php'); ?>

    <div class="board">
    <h1>Pannes n°<?= $idPanne ?></h1>
    <button href="/user-sav" class="btn-gray">Retour</button>

    <div class="gestion-pannes">

    <form action="" method="POST" id="chatForm">
        <div class="chatbox">
            <div class="chatbox-header">
                <h3>Contact</h3>
            </div>
            <div class="chatbox-body" id="chat">
            </div>
            <div class="input-message-btn">
                <input class="chatbox-message-input" type="text" name="message">
                <button class="send-button" type='int' name="type" id="msg-btn"><i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </form>

    <script>
        function fetchMessages() {
            fetch('/api/messagesUser?idPanne=<?= $idPanne ?>')
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
                        if (old != chatBody.innerHTML) {
                            chatBody.scrollTop = chatBody.scrollHeight;
                        }
                    }
                )
        }

        const chatBody = document.getElementById("chat");
        const button = document.getElementById("msg-btn");

        setInterval(fetchMessages, 500);

        const formulaire = document.getElementById("chatForm");
        formulaire.addEventListener("submit", function (e) {
            let varForm = new FormData(formulaire);
            e.preventDefault();
            fetch('/api/sendUser?idPanne=<?= $idPanne ?>', {
                method: 'POST',
                body: varForm
            }).then(fetchMessages)
        });
    </script>

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