<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ScenarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="scenario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'time_on') ?>

    <?= $form->field($model, 'time_off') ?>

    <?= $form->field($model, 'brightness') ?>

    <?php // echo $form->field($model, 'week_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
