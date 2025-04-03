<?php
/** @var yii\web\View $this
 * @var app\models\Device $device
 * @var app\models\Type $type
 */

use app\models\DeviceUser;
use yii\helpers\Url;


$this->title = 'Типы устройств';
?>
    <div class="container d-flex align-items-center justify-content-center">
        <h1><?= $type->name ?></h1>
    </div>
    <div class="device-container d-flex flex-wrap container  my-2">
        <?php foreach ($device as $item): ?>
            <div class="device-card" style="background-color: #f3f2f2;">
                <div class="image-container">
                    <img src="/<?= $item->img ?>" alt="<?= htmlspecialchars($item->name) ?>" class="device-image">
                </div>
                <div class="d-flex align-items-center justify-content-between flex-column p-4 h-100">
                    <h5 class="d-flex align-items-center justify-content-center text-center"><?= htmlspecialchars($item->name) ?></h5>
                    <a href="<?= Url::toRoute(['device/view', 'id' => $item->id]); ?>"
                       class="btn btn-primary">Просмотреть</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="device-other my-5 container">
        <div class="device_other_text">
            <h2>Не нашли своё устройство?</h2>
            <a href="<?= Url::toRoute(['device/create', 'type_id' => $type->id]); ?>" class="btn btn-outline-light">Добавить
                своё устройство</a>
        </div>
        <?php if (!empty($device)): ?>
            <img src="/<?= $device[0]->img ?>" alt="<?= $device[0]->name ?>">
        <?php endif; ?>

    </div>

<?php endif; ?>