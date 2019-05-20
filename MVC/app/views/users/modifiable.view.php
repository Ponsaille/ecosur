<?php require('partials/head.php');?>
<div class="board">
    <h1><?= $modifiable->titre ?></h1>
    <form method="POST" action="/webmaster/modifiables?id=<?= $modifiable->idElementsModifiables ?>" style="text-align: left;">
        <textarea name="contenu" cols="30" rows="10"><?= $modifiable->contenu ?></textarea><br>
        Type: <?= $modifiable->type ?><br>
        <input class="btn-gray" type="submit" value="Modifier">
    </form>
    <a href="/webmaster">Retourner à la liste des modifiables</a>
</div>
<?php require('partials/footer.php'); ?>