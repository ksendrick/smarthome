<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Device $model */

$this->title = Yii::t('app', 'Обновить устройство: {name}', [
    'name' => $model->name,
]);
?>
<div class="device-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
