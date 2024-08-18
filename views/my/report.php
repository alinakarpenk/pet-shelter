<?php
/** @var array $favoritePets */
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
    <table>
        <tr class="name-table">
            <th>Id</th>
            <th>Ім'я</th>
            <th>Ім'я тварини</th>
        </tr>
        <?php foreach ($favoritePets as $item): ?>
            <tr class="item-table">
                <th><p class="id"><?php echo ($item['id']); ?></p></th>
                <th><p class="user-name"><?php echo ($item['user_email']); ?></p></th>
                <th><p class="pet-name"><?php echo ($item['pet_name']); ?></p></th>
            </tr>
        <?php endforeach;?>
    </table>
<?php endif; ?>
</body>
</html>

