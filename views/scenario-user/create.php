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
    <img src="/<?= $scenario->type->img ?>" alt="<?= $scenario->name ?>">
    <div class="form-scenario_text">
        <?php $form = ActiveForm::begin(); ?>


        <h1><?= Html::encode($this->title) ?> для <?= $scenario->type->name ?></h1>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'time_on')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'time_off')->textInput(['type' => 'time']) ?>
        <?= $form->field($model, 'week_id')->dropDownList(ArrayHelper::map(Week::find()->all(), 'id', 'name')) ?>

        <?= $form->field($model, 'brightness')->input('number') ?>
        <div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
<?php if (!empty($devices)): ?>
    <h5 class="container mt-4">Подключённые устройства для данного сценария: </h5>
    <div class="device-container d-flex flex-wrap container" style="padding: 0">
        <?php foreach ($devices as $item): ?>
            <div class="device-card">
                <div class="image-container">
                    <img src="/<?= $item->device->img ?>" alt="<?= $item->device->name ?>" class="device-image">
                </div>
                <p style="padding: 15px;"><?= $item->device->name ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <h5 class="container mt-4">Нет подключенного устройства для данного сценария </h5>
<?php endif; ?>
<style>
    body {
        background-color: #f3f2f2;
    }

    .form-scenario img {
        background-position-x: left;
    }
</style>