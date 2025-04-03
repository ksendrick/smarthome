<?php
/** @var yii\web\View $this */

use app\models\DeviceUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Группа ' . $group->name;

?>
<div class="group container">
    <div class="group_text">
        <h2>Группа <?= $group->name ?></h2>
        <img src="/<?= $group->groupImg->img ?>" alt="<?= $group->name ?>" class="group_img">
    </div>
    <div class="group_device">
        <h2>Выбрать устройство</h2>
        <div class="d-flex flex-wrap justify-content-around">
            <?php foreach ($availableDevices as $device): ?>
                <div class="device-card mb-3" data-id="<?= $device->id ?>"
                     style="background-color: #f3f2f2; margin: 10px">
                    <div class="image-container">
                        <img src="/<?= $device->device->img ?>" alt="<?= htmlspecialchars($device->device->name) ?>"
                             class="device-image">
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-column p-4">
                        <h5><?= htmlspecialchars($device->device->name) ?></h5>
                        <a href="<?= Url::toRoute(['site/device', 'id' => $device->id]); ?>"
                           class="btn btn-primary">Просмотреть</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" id="selected-device-id" name="GroupDeviceUserForm[device_user_id]" value="">
        <div class="my-3">
            <?= Html::submitButton('Подключить', ['class' => 'btn btn-primary', 'name' => 'login-button', 'disabled' => true]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>


<script>
    document.querySelectorAll('.device-card').forEach(function (card) {
        card.addEventListener('click', function () {
            var deviceId = this.getAttribute('data-id');
            document.getElementById('selected-device-id').value = deviceId;
            document.querySelector('button[name="login-button"]').disabled = false;
            document.querySelectorAll('.device-card').forEach(function (otherCard) {
                otherCard.style.border = '1px solid #ccc';
            });
            this.style.border = '2px solid blue';
        });
    });
</script>

<div class="container my-3">
    <h2>Подключенные устройства</h2>
    <?php if (!empty($connectedDevices)): ?>
        <div class="group_card d-flex flex-wrap align-items-start">

            <?php foreach ($connectedDevices as $device): ?>
                <div class="device-card mb-3" style="background-color: #f3f2f2; margin: 15px">
                    <div class="image-container">
                        <img src="/<?= $device->device->img ?>" alt="<?= htmlspecialchars($device->device->name) ?>"
                             class="device-image">
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-column p-4">
                        <h5><?= htmlspecialchars($device->device->name) ?></h5>
                        <a href="<?= Url::toRoute(['site/device', 'id' => $device->id]); ?>"
                           class="btn btn-primary">Просмотреть</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <a href="<?= Url::to(['group/enable-click', 'id' => $group->id]) ?>" class="btn btn-primary">Включить
                все устройства</a>
            <a href="<?= Url::to(['group/disable-click', 'id' => $group->id]) ?>" class="btn btn-secondary">Выключить
                все устройства</a>
        </div>
    <?php else: ?>
        <p>Нет подключенных устройств.</p>
    <?php endif; ?>

</div>
