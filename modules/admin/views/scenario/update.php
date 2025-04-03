<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Scenario $model */

$this->title = Yii::t('app', 'Обновить сценарий: {name}', [
    'name' => $model->name,
]);
?>
<div class="scenario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
