<div class="overlay" id="new_capteur_overlay">
    <div class="overlay_background overlay_close"></div>
    <div class="overlay_content">
        <div class="overlay_header">
            <i class="fas fa-times overlay_close"></i>
        </div>
        <div class="overlay_body">

            <!-- Formulaire de connexion -->
            <div class="overlay_body_left">
                <h2>Nouveau capteur</h2>
                <form action="/addComposant" method="POST">
                    <label class="full-length">
                        <span>Types</span>
                        <select class="dropdown" name="type-composant">
                            <option>Luminosité</option>
                            <option>Chauffage</option>
                            <option>Infrarouge</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </label>
                    <label class="full-length">
                        <span>Mot de passe</span>
                        <input type="password" name="password">
                    </label>
                    <input class="btn-gray" type="submit" value="Se connecter">

                    <label class="half-length">
                        <span>Prénom</span>
                        <input type="text" name="prenom">
                    </label>
                    <label class="full-length">
                        <span>Mot de passe</span>
                        <input type="password" name="password">
                    </label>
                    <input class="btn-gray" type="submit" value="Se connecter">
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/public/javascript/overlay.js"></script>
<script>
    const loginOverlay = new Overlay(document.getElementById('new_capteur_overlay'), document.getElementsByClassName('btn_new_capteur'));
</script>
</body>

</html>