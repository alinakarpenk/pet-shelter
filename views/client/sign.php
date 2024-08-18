
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/views/client/css/clientStyle.css" rel="stylesheet">
    <script src="/views/client/js/signAsync.js" defer></script>
</head>
<body>
<form method="POST" action="" class="sign">
    <div class="error-p">
    <p id="responseMessage"></p>
    </div>
    <label for="email">Електрона пошта</label>
    <input id="email" type="text" name="email">
    <label for="password">Пароль</label>
    <input id="password" type="password" name="password">
    <input type="submit" id="register" value="Увійти">
    <p>Ще не маєте аккаунт?</p><a href="http://test/client/add">Зареєструватися</a>
</form>
</body>
</html>
