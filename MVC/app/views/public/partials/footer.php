<!-- Footer de la page d'accueil -->
<footer>
    <ul>
        <li><a href="#domisep-anchor">Qui sommes nous ?</a></li>
        <li><a href="">Condition d'utilisation</a></li>
        <li><a href="">Condition de confidentialité</a></li>
        <li><a href="#contact-anchor">Nous contacter</a></li>
    </ul>
    <ul>
        <li><a href="#contact-anchor">Nous contacter</a></li>
        <li><a href="">Commentaire</a></li>
    </ul>
    <ul>
        <li><a href="">Facebook</a></li>
        <li><a href="">Instagram</a></li>
        <li><a href="">Twitter</a></li>
        <li><a href="">Linkedin</a></li>
    </ul>
    <p id="footer-copyright">© DomIsep - 2019</p>
</footer>

<!-- Overlay ouvert lorsqu'on clique sur "Connection" dans la barre de navigation -->
<div class="overlay" id="login_overlay">
    <div class="overlay_background overlay_close"></div>
    <div class="overlay_content">
        <div class="overlay_header">
            <i class="fas fa-times overlay_close"></i>
        </div>
        <div class="overlay_body">

            <!-- Formulaire de connexion -->
            <div class="overlay_body_left">
                <h2>Connexion</h2>
                <form action="/connexion" method="POST">
                    <label class="full-length">
                        <span>Email</span>
                        <input type="text" name="email">
                    </label>
                    <label class="full-length">
                        <span>Mot de passe</span>
                        <input type="password" name="password">
                    </label>
                    <input class="btn-gray" type="submit" value="Se connecter">
                </form>
            </div>

            <!-- Formulaire d'inscription -->
            <div class="overlay_body_right">
                <h2>Inscription</h2>
                <form action="/inscription" method="POST">
                    <label class="half-length">
                        <span>Prénom</span>
                        <input type="text" name="prenom">
                    </label>
                    <label class="half-length">
                        <span>Nom</span>
                        <input type="text" name="nom">
                    </label>
                    <label class="full-length">
                        <span>Email</span>
                        <input type="text" name="email">
                    </label>
                    <label class="full-length">
                        <span>Adresse</span>
                        <input type="text" name="adresse">
                    </label>
                    <label class="half-length">
                        <span>Ville</span>
                        <input type="text" name="ville">
                    </label>
                    <label class="half-length">
                        <span>Code Postal</span>
                        <input type="text" name="code_postal">
                    </label>
                    <label class="full-length">
                        <span>Pays</span>
                        <input type="text" name="pays">
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
    const loginOverlay = new Overlay(document.getElementById('login_overlay'), document.getElementById('connexion_header'));
</script>
</body>

</html>