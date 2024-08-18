<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="/views/client/css/clientStyle.css" rel="stylesheet">
    <script src="/views/client/js/registrationAsync.js" defer></script>
</head>
<body>
<form method="POST" action="" class="register">
    <div class="error-p">
    <p id="message"></p>
    </div>
    <label for="name">Ім'я</label>
    <input id="name" type="text" name="name">
    <label for="surname">Прізвище</label>
    <input id="surname" type="text" name="surname">
    <label for="email">Електрона пошта</label>
    <input id="email" type="text" name="email">
    <label for="password">Пароль</label>
    <input id="password" type="password" name="password">
    <label for="password2">Повторіть пароль</label>
    <input id="password2" type="password" name="password2">
    <input type="submit" id="register" value="Зареєструватися">
</form>
</body>
</html>
