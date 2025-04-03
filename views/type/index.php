<?php
/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Типы устройств';
?>
<div id="category">
    <div class="container d-flex flex-wrap my-3">
        <?php foreach ($type as $item): ?>
            <div class="type_item" style="background-image: url('/<?= $item->img ?>');">
                <div class="type_span d-flex flex-column p-3">
                    <h5><?= $item->name ?></h5>
                    <a href="<?= Url::toRoute(['device/index', 'type_id' => $item->id]); ?>">Подробнее</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>