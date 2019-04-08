<?php require('app/views/partials/head.php'); ?>

<!--
    <h1>
        <?= $greeting; ?>
    </h1>
    <ul>
        <?php foreach($tasks as $task): ?>
            <li style="<?= $task->isCompleted() ? "text-decoration: line-through" : ""; ?>">    
                <?= $task->getDescription(); ?>
            </li>
        <?php endforeach ?>
    </ul>
!-->


<h1>Home page</h1>

<?php require('app/views/partials/footer.php'); ?>