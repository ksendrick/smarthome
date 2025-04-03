<?php

use app\models\Device;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DeviceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Устройства');
?>
<div class="device-index">

    <div class="d-flex flex-wrap justify-content-between mt-3">
        <h2><?= Html::encode($this->title) ?></h2>

        <p>
            <?= Html::a(Yii::t('app', 'Создать устройство'), ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute'=>'img',
                'format' => 'html',
                'value'=>function ($data) {
                    return Html::img(Yii::$app->request->baseUrl . '/' . $data->img, [
                        'alt' => $data->name,
                        'style' => 'width:100px;'
                    ]);
                }
            ],
            //'type_id',
            //'scenario_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Device $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
