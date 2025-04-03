<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Scenario $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="scenario-view">

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
            'time_on',
            'time_off',
            'brightness',
            [
                'attribute' => 'week_id',
                'value' => function ($data) {
                    return $data->week->name ?? 'Нет повтора';
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type->name ?? 'Нет типа';
                }
            ],
        ],
    ]) ?>

</div>
