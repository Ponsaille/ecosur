<?php require('app/views/partials/head.php'); ?>

<h1>Submit your name!</h1>

<form method="POST" action="/users">
    <input name="name" type="text">
    <input type="submit" value="Submit">
</form>

<ul>
    <?php foreach($users as $user) : ?>
    <li><?= $user->name; ?></li>
    <?php endforeach; ?>
</ul>

<?php require('app/views/partials/footer.php'); ?>