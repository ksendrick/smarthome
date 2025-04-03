<?php

use app\models\Type;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Типы устройств');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <div class="d-flex flex-wrap justify-content-between mt-3">
        <h2><?= Html::encode($this->title) ?></h2>

        <p>
            <?= Html::a(Yii::t('app', 'Создать тип устройства'), ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

    </div>
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Type $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
