<?php
/** @var array $amount */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/views/donat/js/asyncDonat.js" defer></script>
    <link href="/views/donat/donatStyle.css" rel="stylesheet">
</head>
<body>
<div class="pay-container">
<form method="POST" class="send-form">
    <div class="error-p">
        <p id="message"></p>
    </div>
    <label for="name">Ім'я:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="card_number">Номер картки:</label>
    <input type="text" id="card_number" name="card_number" required placeholder="0000 0000 0000 0000"><br><br>
    <label for="date">Термін дії:</label>
    <input type="text" id="date" name="date" required placeholder="MM/YY"><br><br>
    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required placeholder="···"><br><br>
    <button type="submit">Оплатити <?php
        echo $amount; ?> гривень</button>
</form>
</div>
</body>
</html>
