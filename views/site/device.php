<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

//
//$this->title = $device_user->device->name;
?>
<div class="device-view container mt-5">
    <img src="/<?= $device_user->device->img ?>" class="p-3">


    <div class="device-desc mt-3">
        <div class="d-flex flex-column">
            <h2><?= $device_user->device->name ?></h2>
            <p><?= $device_user->device->type->name ?></p>
        </div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'time_on')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'time_off')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'is_click')->checkbox([
            'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

        </div>

        <?php ActiveForm::end(); ?>
        <div class="d-flex my-3">
            <?= Html::beginForm(['device/disconnect', 'deviceId' => $device_user->device->id, 'userId' => Yii::$app->user->id], 'post') ?>
            <?= Html::submitButton('Отключить устройство', ['class' => 'btn btn-outline-danger']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>

</div>
<style>
    body {
        background-color: #f3f2f2;
    }

    form {
        width: 100%;
    }
</style>