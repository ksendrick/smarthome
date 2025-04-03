<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Type $model */

$this->title = Yii::t('app', 'Обновить тип: {name}', [
    'name' => $model->name,
]);
?>
<div class="type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
