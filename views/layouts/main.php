<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/img/logo1.png')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta name="description" content="Умный дом - ваш комфорт и безопасность под контролем. Управляйте освещением, климатом и безопасностью с помощью современных технологий.">
    <meta name="keywords" content="умный дом, системы умного дома, управление домом, автоматизация, безопасность, умное освещение, умные устройства">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/img/logo.png', ['width' => '120', 'height' => 'auto']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Административная панель', 'url' => ['/admin'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin],
            ['label' => 'Главная', 'url' => ['/'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Регистрация', 'url' => ['/register'], 'visible' => Yii::$app->user->isGuest, 'options' => ['class' => 'btn_light']],
            ['label' => 'Профиль', 'url' => ['/profile'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Уведомления',
                'url' => ['/notifications'],
                'visible' => !Yii::$app->user->isGuest,
                'options' => ['id' => 'reminder-button']
            ],
            ['label' => 'Устройства', 'url' => ['/type'], 'visible' => !Yii::$app->user->isGuest],
            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/login'], 'options' => ['class' => 'btn_dark']]
                : '<li class="nav-item">'
                . Html::beginForm(['/logout'])
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?= Alert::widget() ?>
    </div>
    <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3" style="background-color: #f3f2f2">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid" >
                <a class="navbar-brand" href="<?= Url::toRoute(['/']) ?>"><img src="/img/logo.png" alt="Лого"
                                                                               style="width: 120px; height: auto"></a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= Url::toRoute(['/']) ?>">Главная</a>
                    </li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::toRoute(['/register']) ?>">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::toRoute(['/login']) ?>">Войти</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::toRoute(['/profile']) ?>">Профиль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::toRoute(['/type']) ?>">Устройства</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::toRoute(['/logout']) ?>">Выйти</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(function() {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 10000);
        }

        glowNavbarButton();
    });

    function glowNavbarButton() {
        var navbarButton = document.getElementById('reminder-button');
        if (navbarButton) {
            console.log('Navbar button found');
            checkUnreadNotifications();
        } else {
            console.log('Navbar button not found');
        }
    }

    function checkUnreadNotifications() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/notifications/check-unread', true);
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);

                    // Обработка уведомлений
                    if (response.hasUnreadDeviceUser || response.hasValidUnreadNotification) {
                        console.log('Unread notifications found, adding class');
                        document.getElementById('reminder-button').classList.add('unread-notification');
                    } else {
                        console.log('No unread notifications');
                        document.getElementById('reminder-button').classList.remove('unread-notification');
                        document.getElementById('reminder-button').style.textDecoration = 'none';
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    console.error('Response text:', xhr.responseText); // Выводим текст ответа для отладки
                }
            } else {
                console.error('Error fetching notifications:', xhr.statusText);
                console.error('Response text:', xhr.responseText); // Выводим текст ответа для отладки
            }
        };

        xhr.onerror = function() {
            console.error('Network error while fetching notifications');
        };

        xhr.send();
    }


</script>
<style>
    .unread-notification::after {
        content: '';
        display: inline-block;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background-color: rgba(67, 86, 181, 0.91);
        box-shadow: 0 0 10px rgba(114, 134, 211, 0.4);
        margin-right: 10px;
    }
    #reminder-button{
        display: flex;
        align-items: baseline;
    }
</style>
