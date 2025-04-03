<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use app\models\GroupImg;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Создание группы устройств';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form container mt-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <label class="control-label">Выберите изображение</label>
        <div class="row">
            <?php foreach (GroupImg::find()->all() as $groupImg): ?>
                <div class="col-md-3">
                    <label class="image-checkbox">
                        <img src="/<?= Url::to($groupImg->img) ?>" alt="<?= Html::encode($groupImg->img) ?>"
                             class="group-image">
                        <input type="radio" name="GroupForm[group_img_id]" value="<?= $groupImg->id ?>">
                        <i class="fa fa-check hidden"></i>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary mt-2', 'name' => 'login-button', 'disabled' => true]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    document.querySelectorAll('.image-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('click', function () {

            document.querySelectorAll('.image-checkbox').forEach(function (otherCheckbox) {
                otherCheckbox.classList.remove('image-checkbox-checked');
            });

            this.classList.add('image-checkbox-checked');

            var radioInput = this.querySelector('input[type="radio"]');
            radioInput.checked = true;

            document.querySelector('button[name="login-button"]').disabled = false;
        });
    });
</script>


