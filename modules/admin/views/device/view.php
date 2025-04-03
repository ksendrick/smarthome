<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Device $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Устройства'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="device-view_admin">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::$app->request->baseUrl . '/' . $data->img, [
                        'alt' => $data->name,
                        'style' => 'width:100px;'
                    ]);
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type->name ?? 'Нет типа';
                }
            ],
            [
                'attribute' => 'scenario_id',
                'value' => function ($data) {
                    return $data->scenario->name ?? 'Нет сценария';
                }
            ],

        ],
    ]) ?>

</div>
