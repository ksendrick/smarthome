<?php

namespace app\controllers;

use app\models\DeviceUser;
use app\models\Scenario;
use app\models\ScenarioUser;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ScenarioUserController extends Controller
{
    public function actionCreate($scenarioId)
    {
        $scenario = $this->findScenario($scenarioId);
        $existingUserScenario = ScenarioUser::find()
            ->where(['user_id' => Yii::$app->user->id, 'scenario_id' => $scenarioId])
            ->one();
        $model = $existingUserScenario ?: new ScenarioUser();

        if ($scenario) {
            $model->name = $scenario->name;
            $model->time_on = $scenario->time_on;
            $model->time_off = $scenario->time_off;
            $model->brightness = $scenario->brightness;
            $model->week_id = $scenario->week_id;
            $model->type_id = $scenario->type_id;
            $model->user_id = Yii::$app->user->id;
            $model->scenario_id = $scenarioId;
        }

        $devices = DeviceUser::find()
            ->joinWith('device')
            ->where([
                'device.scenario_id' => $model->scenario_id,
                'device_user.user_id' => Yii::$app->user->id
            ])
            ->all();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/profile']);
        }

        return $this->render('create', [
            'model' => $model,
            'scenario' => $scenario,
            'devices' => $devices,
        ]);
    }



    public function actionUpdate($id)
    {
        $scenario = ScenarioUser::findOne($id);
        $model = ScenarioUser ::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Сценарий обновлен.');
            return $this->redirect(['scenario-user/update', 'id'=>$id]);
        }

        return $this->render('update', [
            'model' => $model,
            'scenario'=>$scenario
        ]);
    }

    protected function findScenario($id)
    {
        if (($model = Scenario::findOne($id)) !== null) {
            return $model;
        }
    }

    public function actionDelete($userId)
    {
        $model = ScenarioUser::find()->where(['user_id' => $userId])->one();

        if ($model !== null) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Сценарий успешно удален.');
        } else {
            Yii::$app->session->setFlash('error', 'Сценарий не найден.');
        }

        return $this->redirect(['/profile']);
    }


}
