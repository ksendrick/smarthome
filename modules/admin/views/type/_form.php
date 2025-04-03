<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Type $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="type-form">

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
    <?= $form->field($model, 'img')->fileInput(['class'=>'mt-3']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
