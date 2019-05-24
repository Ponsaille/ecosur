<?php require('partials/head.php');?>
<div class="board">
    <h1><?= $modifiable->titre ?></h1>
    <form method="POST" action="/webmaster/modifiables?id=<?= $modifiable->idElementsModifiables ?>" class="faq-new mt-3">
        <textarea name="contenu" cols="30" rows="10" class="full-length"><?= $modifiable->contenu ?></textarea><br>
        Type : <?= $modifiable->type ?><br>
        <input class="btn-gray mt-3" type="submit" value="Modifier">
    </form>
    <button class="btn-gray mt-3"><a href="/webmaster">Retourner à la liste des modifiables</a></button>

</div>
<?php require('partials/footer.php'); ?>