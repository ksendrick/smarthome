<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use app\models\Scenario;
use app\models\Type;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Добавление устройства';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form container mt-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <h4><?= $type->name ?></h4>

    <div class="d-flex flex-row align-items-baseline">
        <p class="me-3">Другой тип устройства? </p>
        <?= $form->field($model, 'checkBox')->checkbox([
            'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'id' => 'checkBoxId',
        ]) ?>
    </div>

    <div id="otherField" style="display: none">
        <?= $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(Type::find()->all(), 'id', 'name'),
            ['prompt'=>'Выберите тип устройства']
        ) ?>
    </div>

    <?= $form->field($model, 'scenario_id')->dropDownList(
        ArrayHelper::map(Scenario::find()->all(), 'id', 'name'),
        ['prompt'=>'Выберите сценарий']
    ) ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    <div>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function () {
    $('#checkBoxId').change(function (){
        if($(this).is(':checked')) {
            $('#otherField').show();
        } else{
            $('#otherField').hide();
        }
    });
});
JS;

$this->registerJs($script);
?>

<style>
    body {
        background: linear-gradient(to right, #27275a, rgba(67, 85, 183, 0.84));
    }
</style>
