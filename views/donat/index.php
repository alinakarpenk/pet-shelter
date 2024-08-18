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
<div class="main-container">
<h2>Бажаєте допомогти тваринкам?</h2>
<div class="donat-container">
<form method="POST">
    <label for="amount">Введіть суму пожертвування:</label>
    <input type="text" id="amount" name="amount" placeholder="Сума пожертвування (UAH)"  required><br><br>
    <button type="submit" onclick="window.location.href='/donat/send'">Перейти до оплати</button>
</form>
</div>
</div>
</body>
</html>
