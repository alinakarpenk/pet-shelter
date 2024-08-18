<?php
/** @var array $favoritePets */
use models\User;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/views/my/myStyle.css" rel="stylesheet">
</head>
<body>
<?php if (!empty($favoritePets)): ?>
    <?php foreach ($favoritePets as $item): ?>
        <div class="pet-item" <?php echo $item['id']; ?>>
            <p class="pet-image"><img src="/<?php echo $item['image'];  ?> " alt='image pet'></p>
            <h2 class="pet-name"><?php echo $item['name']; ?></h2>
            <p class="pet-description"><?php echo $item['description']; ?></p>
            <?php if (!(new User())->isAdmin()) : ?>
                <button class="pet" onclick="window.location.href='/my/delete/<?php echo $item['id'];?>'">Відмінити</button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="no-pet">
    <p class="no-pet-p">У вас ще немає тварин.</p>
</div>
<?php endif; ?>
</body>
</html>


