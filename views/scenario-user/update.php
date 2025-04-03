<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use app\models\Week;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Сценарий';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-scenario container mt-5">
    <img src="/<?= $scenario->type->img ?>" alt="<?= $scenario->type->name ?>">
    <div class="form-scenario_text">
        <?php $form = ActiveForm::begin(); ?>


        <h1>Обновление сценария</h1>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'time_on')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'time_off')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'week_id')->dropDownList(ArrayHelper::map(Week::find()->all(), 'id', 'name')) ?>

        <?= $form->field($model, 'brightness')->input('number') ?>
        <div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?= Html::a('Удалить сценарий', ['scenario-user/delete', 'userId' => $model->user_id], [
            'class' => 'btn btn-outline-danger mt-3',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот сценарий?',
                'method' => 'post',
            ],
        ]) ?>

    </div>

</div>

<style>
    body {
        background-color: #f3f2f2;
    }

    .form-scenario img {
        background-position-x: left;
    }
</style>