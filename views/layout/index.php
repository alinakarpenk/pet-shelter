<?php
/** @var string $Title */
/** @var string $Content */
/** @var array $ShowButtons */
/** @var bool $showAllButton */

use models\User;
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
<link href="/views/layout/style.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <h1>Притулок для тварин</h1>
        <nav>
            <ul>
                <li><a href="http://test">Головна сторінка</a></li>
                <li><a href="http://test/category/get">Тварини для адопції</a></li>
                <?php if ((new User())->isAdmin()) : ?>
                <li><a href="http://test/my/report">Звіти про адопцію</a></li>
                <?php endif; ?>
                <?php if (!(new User())->isAdmin()) : ?>
                <li><a href="http://test/donat/index">Пожертви</a></li>
                <?php endif; ?>
                <?php if ((new User())->isAdmin()) : ?>
                <li><a href="http://test/donat/report">Фінансові звіти</a></li>
                <?php endif; ?>
                <?php if ((new User())->isLogged()) : ?>
                <?php if (!(new User())->isAdmin()) : ?>
                    <li><a href="http://test/my/view">Мої улюбленці</a></li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (!(new User())->isLogged()) : ?>
                    <li><a href="http://test/client/sign">Увійти</a></li>
                <?php endif; ?>
                <?php if ((new User())->isLogged()) : ?>
                    <li><a href="http://test/client/logout">Вихід</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<?php if ((new User())->isAdmin()) : ?>
    <?php if (isset($ShowButtons) && is_array($ShowButtons)) : ?>
        <?php foreach ($ShowButtons as $button): ?>
            <div class="item-container">
                <button class="item" onclick="window.location.href='<?=$button['URL']?>'"><?=$button['content']?></button>
            </div>
        <?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
    <?php if (isset($showAllButton) && $showAllButton): ?>
        <div class="item-container">
            <button class="item-all" onclick="window.location.href='/pet/get'">Переглянути всих тварин</button>
        </div>
    <?php endif; ?>
<div class="content">
    <?=$Content?>
</div>
<footer>
    <div class="container">
        <p>&copy; 2024 Притулок для тварин. Всі права захищені.</p>
    </div>
</footer>
</body>
</html>
