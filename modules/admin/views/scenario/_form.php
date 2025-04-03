<?php

use app\models\Type;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Scenario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="scenario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_on')->textInput(['type'=>'time']) ?>

    <?= $form->field($model, 'time_off')->textInput(['type'=>'time']) ?>

    <?= $form->field($model, 'brightness')->input('number') ?>

    <?= $form->field($model, 'week_id')->dropDownList(
        ArrayHelper::map(\app\models\Week::find()->all(), 'id', 'name'),
        ['prompt'=>'Выберите повтор']
    ) ?>


    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(Type::find()->all(), 'id', 'name'),
        ['prompt'=>'Выберите тип устройства']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success mt-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
