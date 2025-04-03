<?php

use app\models\Scenario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ScenarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Сценарии');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenario-index">

    <div class="d-flex flex-wrap justify-content-between mt-3">
        <h2><?= Html::encode($this->title) ?></h2>

        <p>
            <?= Html::a(Yii::t('app', 'Создать сценарий'), ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'time_on',
            'time_off',
            'brightness',
            //'week_id',
            //'type_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Scenario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
