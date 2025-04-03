<?php

use app\models\Scenario;
use app\models\Type;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Device $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if ($model->img) : ?>
        <div class="form-group">
            <label class="control-label">Текущее фото</label>
            <div>
                <?= Html::img(Yii::$app->request->baseUrl . '/' . $model->img, ['alt' => 'Current Image', 'style' => 'max-width:200px; max-height: 150px;']) ?>
            </div>
        </div>
    <?php endif; ?>
    <?= $form->field($model, 'img')->fileInput(['class' => 'mt-3']) ?>


    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(Type::find()->all(), 'id', 'name'),
        ['prompt'=>'Выберите тип устройства']
    ) ?>

    <?= $form->field($model, 'scenario_id')->dropDownList(
        ArrayHelper::map(Scenario::find()->all(), 'id', 'name'),
        ['prompt'=>'Выберите сценарий']
    ) ?>

    <?= $form->field($model, 'other')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success mt-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
