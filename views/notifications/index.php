<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$counter = 0;

$this->title = 'Уведомления';
?>
<div class="notifications-index container">

    <div class="notification d-flex flex-wrap justify-content-between my-4">
        <h3 >Уведомления</h3>
        <div>
            <?= Html::a('Отметить все как прочитанные', ['mark-all-as-read'], [
                'class' => 'btn btn-primary',
                'data' => [
                    'method' => 'post',
                ],

            ]) ?>
        </div>
    </div>
    <?php
    $totalNotifications = count($notifications);
    $totalDevices = count($devices);

    $unreadNotifications = array_filter($notifications, function($notification) {
        return !$notification->is_read;
    });
    $readNotifications = array_filter($notifications, function($notification) {
        return $notification->is_read;
    });

    $unreadDevices = array_filter($devices, function($device) {
        return !$device->read_at;
    });
    $readDevices = array_filter($devices, function($device) {
        return $device->read_at;
    });
    ?>

    <?php if (empty($devices) && empty($notifications)): ?>
        <div class="alert alert-primary" role="alert">
            Нет новых уведомлений и уведомлений о устройствах.
        </div>
    <?php else: ?>
        <?php if (!empty($unreadNotifications)): ?>
            <?php $counter = 0; ?>

            <?php
            usort($unreadNotifications, function ($a, $b) {
                return $b->created_at <=> $a->created_at;
            });
            ?>

            <?php foreach ($unreadNotifications as $notification): ?>
                <div class="card my-2 <?= $notification->is_read ? 'opacity-50' : '' ?>" style="max-width: 100%;">
                    <a href="<?= Url::to(['read', 'id' => $notification->id]) ?>">
                        <div class="d-flex flex-row justify-content-between align-items-center flex-wrap my-2">
                            <div class="d-flex flex-row">
                                <h5 class="card-text mb-3">
                                    <span class="unread-notification"></span>
                                    <?= Html::encode($notification->message) ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($unreadDevices)): ?>
            <?php $counter = 0; ?>

            <?php
            usort($unreadDevices, function ($a, $b) {
                return $b->id <=> $a->id;
            });
            ?>

            <?php foreach ($unreadDevices as $device): ?>
                <div class="card my-2 <?= $device->read_at ? 'opacity-50' : '' ?>" style="max-width: 100%;">
                    <a href="<?= Url::to(['mark-as-read', 'id' => $device->id]) ?>" class="text-decoration-none">
                        <div class="d-flex flex-row justify-content-between align-items-center flex-wrap my-2">
                            <div class="d-flex flex-row">
                                <h5 class="card-text mb-3">
                                    <span class="unread-notification"></span>
                                    Устройство <?= Html::encode($device->device->name) ?> имеет статус ошибки
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($readNotifications)): ?>
            <?php $counter = 0; ?>

            <?php
            usort($readNotifications, function ($a, $b) {
                return $b->created_at <=> $a->created_at;
            });
            ?>

            <?php foreach ($readNotifications as $notification): ?>
                <div class="card my-2 opacity-50" style="max-width: 100%;">
                    <a href="<?= Url::to(['read', 'id' => $notification->id]) ?>">
                        <div class="d-flex flex-row justify-content-between align-items-center flex-wrap my-2">
                            <div class="d-flex flex-row">
                                <h5 class="card-text mb-3">
                                    <?= Html::encode($notification->message) ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($readDevices)): ?>
            <?php $counter = 0; ?>

            <?php
            usort($readDevices, function ($a, $b) {
                return $b->id <=> $a->id;
            });
            ?>

            <?php foreach ($readDevices as $device): ?>
                <div class="card my-2 opacity-50" style="max-width: 100%;">
                    <a href="<?= Url::to(['site/device', 'id' => $device->id]) ?>" class="text-decoration-none">
                        <div class="d-flex flex-row justify-content-between align-items-center flex-wrap my-2">
                            <div class="d-flex flex-row">
                                <h5 class="card-text mb-3">
                                    Устройство <?= Html::encode($device->device->name) ?> имеет статус ошибки
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    .notification a{
        color: white !important;
    }
    a {
        color: #1f1f1f !important;
        text-decoration: none;
    }

</style>