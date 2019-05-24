<?php require('partials/head.php');?>
<div class="board">
    <h1><?= $faq->question ?></h1>
    <form method="POST" action="/webmaster/faqs?id=<?= $faq->idFAQ ?>" class="faq-new mt-3">
        <textarea name="reponse" cols="30" rows="10" class="full-length"><?= $faq->reponse ?></textarea><br>
        <input class="btn-gray" type="submit" value="Modifier">
        <button class="btn-gray"><a href="/webmaster/faqs/delete?id=<?= $faq->idFAQ ?>">Supprimer</a></button>
    </form>
    <button class="btn-gray mt-3"><a href="/webmaster">Retourner à la liste</a></button>
</div>
<?php require('partials/footer.php'); ?>