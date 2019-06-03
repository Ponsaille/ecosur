<!-- Footer de la page d'accueil -->
<footer>
    <ul>
        <li><a href="/#domisep-anchor">Qui sommes nous ?</a></li>
        <li><a href="/faq">F.A.Q.</a></li>
    </ul>
    <ul>
        <li><a href="/#contact-anchor">Nous contacter</a></li>
        <li><a href="/cgu">Conditions Générales d'Utilisation</a></li>
    </ul>
    <ul>
        <li><a href="<?= $modifiables["facebook_link"]->contenu ?>">Facebook</a></li>
        <li><a href="<?= $modifiables["instagram_link"]->contenu ?>">Instagram</a></li>
        <li><a href="<?= $modifiables["twitter_link"]->contenu ?>">Twitter</a></li>
        <li><a href="<?= $modifiables["linkedin_link"]->contenu ?>">Linkedin</a></li>
    </ul>
    <p id="footer-copyright"><?= $modifiables["footer_copyright"]->contenu ?></p>
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
                        <input type="email" name="email" required>
                    </label>
                    <label class="full-length">
                        <span>Mot de passe</span>
                        <input type="password" name="password" required>
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
                        <input type="text" name="prenom" required>
                    </label>
                    <label class="half-length">
                        <span>Nom</span>
                        <input type="text" name="nom" required>
                    </label>
                    <label class="full-length">
                        <span>Email</span>
                        <input type="email" name="email" required>
                    </label>
                    <label class="full-length">
                        <span>Adresse</span>
                        <input type="text" name="adresse" required>
                    </label>
                    <label class="half-length">
                        <span>Ville</span>
                        <input type="text" name="ville" required>
                    </label>
                    <label class="half-length">
                        <span>Code Postal</span>
                        <input type="text" name="code_postal" required>
                    </label>
                    <label class="full-length">
                        <span>Pays</span>
                        <input type="text" name="pays" required>
                    </label>
                    <label class="full-length">
                        <span>Mot de passe</span>
                        <input type="password" name="password" required>
                    </label>
                    <input class="btn-gray" type="submit" value="S'inscrire">
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