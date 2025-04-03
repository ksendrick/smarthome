<?php

namespace app\controllers;

use app\models\Device;
use app\models\DeviceForm;
use app\models\DeviceUser;
use app\models\Scenario;
use app\models\Type;
use Yii;
use yii\web\Controller;

class DeviceController extends Controller
{
    public function actionIndex($type_id)
    {

        $type=Type::findOne(['id' => $type_id]);
        $device = Device::find()->where([
            'type_id'=>$type_id,
            'other'=>true
        ])->all();
        $context = [
            'device' => $device,
            'type' => $type,
        ];
        return $this->render('index', $context);
    }

    public function actionView($id)
    {
        $device = Device::findOne($id);
        $scenario = Scenario::find()->where(['id'=>$device->scenario_id])->all();
        $context = [
            'device' => $device,
            'scenario'=>$scenario
        ];
        return $this->render('view', $context);
    }

    public function actionCreate($type_id)
    {
        $model = new DeviceForm();
        $type = Type::findOne(['id' => $type_id]);

        if ($type === null) {
            Yii::$app->session->setFlash('error', 'Тип устройства не найден.');
            return $this->redirect(['site/index']);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->user_id = Yii::$app->user->id;
                $model->type_id = $type_id;

                $device = new Device();
                $device->attributes = $model->attributes;

                if ($device->save()) {
                    $deviceUser = new DeviceUser();
                    $deviceUser->user_id = Yii::$app->user->id;
                    $deviceUser->device_id = $device->id;

                    if ($deviceUser->save()) {
                        Yii::$app->session->setFlash('success', 'Устройство успешно создано и подключено.');

                        return $this->redirect(['site/device', 'id' => $deviceUser->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Устройство создано, но не удалось подключить его к пользователю.');
                    }

                    $device->delete();
                } else {
                    Yii::$app->session->setFlash('error', 'Не удалось создать устройство.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка загрузки данных.');
            }
        }

        $context = [
            'type' => $type,
            'model' => $model,
        ];

        return $this->render('create', $context);
    }



    public function actionConnect() {
        if (Yii::$app->request->isPost) {
            $deviceId = Yii::$app->request->post('device_id');
            $userId = Yii::$app->request->post('user_id');

            if ($deviceId && $userId) {
                $existingConnection = DeviceUser::find()
                    ->where(['user_id' => $userId, 'device_id' => $deviceId])
                    ->one();

                if ($existingConnection) {
                    Yii::$app->session->setFlash('info', 'Устройство уже подключено к этому пользователю.');
                } else {
                    $deviceUser = new DeviceUser();
                    $deviceUser->user_id = $userId;
                    $deviceUser->device_id = $deviceId;

                    if ($deviceUser->save()) {
                        Yii::$app->session->setFlash('success', 'Устройство успешно подключено.');
                    } else {
                        Yii::$app->session->setFlash('error', 'Ошибка при подключении устройства.');
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Недостаточно данных для подключения устройства.');
            }

            return $this->redirect(['device/view', 'id'=>$deviceId]);
        }
    }

    public function actionDisconnect($deviceId, $userId) {
        if (Yii::$app->request->isPost) {
            $deviceUser  = DeviceUser ::find()
                ->where(['user_id' => $userId, 'device_id' => $deviceId])
                ->one();

            if ($deviceUser ) {
                if ($deviceUser ->delete()) {
                    Yii::$app->session->setFlash('success', 'Устройство успешно отключено.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при отключении устройства.');
                }
            } else {
                Yii::$app->session->setFlash('info', 'Устройство не подключено к этому пользователю.');
            }

            return $this->redirect(['site/profile']);
        }

        Yii::$app->session->setFlash('error', 'Неверный запрос.');
        return $this->redirect(['device/view', 'id' => $deviceId]);
    }
}
