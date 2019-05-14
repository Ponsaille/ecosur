<aside id="side-nav">
    <div class="hamburger-button side_nav_close">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <img class="small-logo" src="<?= $modifiables["logo_short"]->contenu ?>" alt="">
    <nav>
        <?php if($_SESSION['user_type'] == 0) { ?>
        <ul>
            <li><a href="/board"><i class="fas fa-cogs fa-fw"></i> <span class="side-nav-text">Capteur/Actionneur</span></a></li>
            <li><a href="/gestion"><i class="fas fa-home fa-fw"></i> <span class="side-nav-text">Gestion de domiciles</span></a></li>
            <li><a href=""><i class="far fa-comment-alt fa-fw"></i> <span class="side-nav-text">Contacter</span></a></li>
            <li><a href=""><i class="fas fa-user fa-fw"></i> <span class="side-nav-text">Données personnelles</span></a></li>
        </ul>
        <?php } ?>
    </nav>
    <span><a href="/disconnect"><i class="fas fa-sign-out-alt fa-fw"></i> <span class="side-nav-text">Logout</span></a></span>
</aside>

<script src="../../../public/javascript/overlay.js"></script>
<script src="../../../public/javascript/side-navbar.js"></script>
<script>
    new SideNavbar(document.getElementById('side-nav'));
</script>