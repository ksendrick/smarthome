<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Smart Home';
?>
<div class="index">
    <img src="/img/smart-speaker-house-control-innovative-technology.jpg" alt="Умный дом">
    <div class="first_banner">
        <h1>Умный дом</h1>
        <p>Это ваш дом, в котором множество умных устройств работают вместе, чтобы незаметно выполнять рутинные
            дела, заботиться о комфорте, микроклимате, уюте и безопасности</p>
    </div>
</div>

<div class="two_back" style="background-color: #f4f4f4;">
    <div class="two_banner container">
        <div class="two_text">
            <h2>Пользуйтесь шаблонами сценариев или создавайте новые</h2>
            <p>
                Например, укажите время, в которое будет запускаться робот-пылесос или включать увлажнитель
                в детской перед сном
            </p>
        </div>
        <img src="/img/Без названия214_20250318144635.png"
             alt="Телефон">
    </div>
</div>

<div class="type_banner">
    <div class="type_text">
        <div class="type_text_h">
            <h2>Типы устройств умного дома</h2>
            <p>Легко объединяйте их между собой — и они будут выполнять десятки разных задач и сценариев</p>
            <div class="d-flex align-items-start">
                <a href="<?= Url::toRoute(['/type']) ?>" class="btn btn-outline-light">Перейти</a>
            </div>
        </div>
    </div>
    <div class="type_content">
        <?php
        $count = 0;
        foreach ($type as $item):
            if ($count >= 4) break;
            ?>
            <div class="type_item <?php if ($count % 2 == 0) echo 'type_item_square'; else echo 'type_item_rectangle'; ?>" style="background-image: url('/<?= $item->img ?>');">
                <div class="type_span d-flex flex-column p-3">
                    <h5><?= $item->name ?></h5>
                    <a href="<?= Url::toRoute(['device/index', 'type_id' => $item->id]); ?>">Подробнее</a>
                </div>
            </div>
            <?php
            $count++;
        endforeach; ?>
    </div>
</div>
