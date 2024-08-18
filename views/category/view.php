<?php
/** @var array $category */
/** @var array $pets */
use models\User;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/views/category/categoryStyle.css" rel="stylesheet">
</head>
<body>
<?php if (!empty($pets)): ?>
    <?php foreach ($pets as $item): ?>
        <div class="pet-item">
            <p class="pet-image"><img class='view' src="/<?php echo $item['image']; ?>"></p>
            <h2 class="pet-name"><?php echo $item['name']; ?></h2>
            <p class="pet-description"><?php echo $item['description']; ?></p>
            <?php if (!(new User())->isAdmin()) : ?>
                <?php if ((new User())->isLogged()) : ?>
                    <button class="pet" onclick="window.location.href='/my/pet/<?php echo $item['id']; ?>'">Приютити</button>
                <?php else: ?>
                    <button class="pet" onclick="window.location.href='/client/sign'">Приютити</button>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ((new User())->isAdmin()) : ?>
                <button type="submit" class="delete-view-item" onclick="window.location.href='/pet/delete/<?php echo $item['id']; ?>'">Видалити</button>
                <button type="submit" class="edit-view-item" onclick="window.location.href='/pet/update/<?php echo $item['id']; ?>'">Змінити</button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
