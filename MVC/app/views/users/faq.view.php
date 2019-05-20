<?php require('partials/head.php');?>
<div class="board">
    <h1><?= $faq->question ?></h1>
    <form method="POST" action="/webmaster/faqs?id=<?= $faq->idFAQ ?>" style="text-align: left;">
        <textarea name="reponse" cols="30" rows="10"><?= $faq->reponse ?></textarea><br>
        <input class="btn-gray" type="submit" value="Modifier">
        <a class="btn-gray" href="/webmaster/faqs/delete?id=<?= $faq->idFAQ ?>">Supprimer</a>
    </form>
    <a href="/webmaster">Retourner à la liste</a>
</div>
<?php require('partials/footer.php'); ?>