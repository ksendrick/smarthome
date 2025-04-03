<?php
/** @var yii\web\View $this
 * @var app\models\Device $device
 * @var app\models\Type $type
 */

use app\models\DeviceUser;
use yii\helpers\Url;


$this->title = 'Типы устройств';
?>
<div class="device-view container mt-5">
    <img src="/<?= $device->img ?>" alt="<?= $device->name ?>">

    <div class="device-desc mt-2">
        <div class="d-flex flex-column">
            <h2><?= $device->name ?></h2>
            <p><?= $device->type->name ?></p>
        </div>
        <?php if (!empty($device->scenario_id)): ?>
            <h3>Подходящий сценарий</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <?php foreach ($scenario as $item): ?>
                        <th scope="col"><?= $item->name ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Время включения</td>
                    <?php foreach ($scenario as $item): ?>
                        <td><?= $item->time_on ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Время выключения</td>
                    <?php foreach ($scenario as $item): ?>
                        <td><?= $item->time_off ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Яркость</td>
                    <?php foreach ($scenario as $item): ?>
                        <td><?= $item->brightness ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Повтор</td>
                    <?php foreach ($scenario as $item): ?>
                        <td><?= $item->week->name ?></td>
                    <?php endforeach; ?>
                </tr>
                </tbody>
            </table>
        <?php endif; ?>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php $isConnected = DeviceUser::find()->where(['user_id' => Yii::$app->user->id, 'device_id' => $device->id])->exists(); ?>
            <?php if (!$isConnected): ?>
                <form method="POST" action="<?= Url::to(['device/connect']) ?>">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="device_id" value="<?= $device->id ?>">
                    <input type="hidden" name="user_id" value="<?= Yii::$app->user->id ?>">
                    <button type="submit" class="btn btn-primary mb-3">Подключить устройство</button>
                </form>
            <?php else: ?>
                <p class="connected">Устройство уже подключено к вам</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    body {
        background-color: #f3f2f2;
    }
</style>