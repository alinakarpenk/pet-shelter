<?php
/** @var array $donat */
$totalAmount = 0;
foreach ($donat as $item) {
    $totalAmount += (float)$item['amount'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/views/donat/donatStyle.css" rel="stylesheet">
</head>
<body>
<?php if (!empty($donat)): ?>
<table>
    <tr class="total-sum">
        <th colspan="3">Загальна сума пожертвувань</th>
        <th ><?php echo number_format($totalAmount, 2, ',', ' ');?> UAH</th>
    </tr>
    <tr class="name-table">
        <th>Ім'я</th>
        <th>Електрона пошта</th>
        <th>Номер карти</th>
        <th>Сума пожертвуванння</th>
    </tr>
<?php foreach ($donat as $item): ?>
    <tr class="item-table">
    <th><p class="name"><?php echo $item['name']; ?></p></th>
    <th><p class="email"><?php echo $item['email']; ?></p></th>
    <th><p class="card_number"><?php echo $item['card_number']; ?></p></th>
    <th><p class="amount"><?php echo $item['amount']; ?> UAH </p></th>
    </tr>
<?php endforeach;?>
</table>
<?php endif; ?>
</body>
</html>

