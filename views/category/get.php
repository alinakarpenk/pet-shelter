<?php
/** @var array $categories */
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
<?php if (!empty($categories)): ?>
    <?php foreach ($categories as $item): ?>
        <div class="category-item">
            <p class="category-image"><img src="/<?php echo $item['image']; ?>"></p>
            <h2 class="category-title"><?php echo $item['title']; ?></h2>
                <button class="category" onclick="window.location.href='/category/view/<?=$item['id']?>'">Переглянути</button>
<?php if ((new User())->isAdmin()) : ?>
                <button type="submit" class="delete-item" onclick="window.location.href='/category/delete/<?= $item['id'] ?>'">Видалити</button>
                <button type="submit" class="edit-item" onclick="window.location.href='/category/update/<?=$item['id'] ?>'">Змінити</button>
           <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>