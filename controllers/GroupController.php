<?php

namespace app\controllers;

use app\models\DeviceUser;
use app\models\Group;
use app\models\GroupDeviceUser;
use app\models\GroupDeviceUserForm;
use app\models\GroupForm;
use app\models\Notification;
use Yii;

class GroupController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new GroupForm();
        $groupId = null;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->user_id = Yii::$app->user->id;

                if ($group = $model->save()) {
                    $groupId = $group->id;
                    return $this->redirect(['index', 'id' => $groupId]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex($id)
    {
        $group = Group::findOne($id);
        $model = new GroupDeviceUserForm();

        $connectedDeviceIds = GroupDeviceUser::find()->select('device_user_id')->where(['group_id' => $id])->column();
        $availableDevices = DeviceUser::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['not in', 'id', $connectedDeviceIds])
            ->all();

        $connectedDevices = DeviceUser ::find()->where(['id' => $connectedDeviceIds])->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->group_id = $id;
                if ($model->save()) {
                    return $this->redirect(['index', 'id' => $id]);
                }
            }
        }

        $context = [
            'group' => $group,
            'model' => $model,
            'availableDevices' => $availableDevices,
            'connectedDevices'=>$connectedDevices
        ];
        return $this->render('index', $context);
    }


    public function actionEnableClick($id)
    {
        // Получаем все подключенные устройства для группы
        $connectedDeviceIds = GroupDeviceUser::find()->select('device_user_id')->where(['group_id' => $id])->column();

        // Получаем устройства, у которых is_click равно 0
        $devicesToUpdate = DeviceUser::find()->where(['id' => $connectedDeviceIds, 'is_click' => 0])->all();

        // Обновляем значение is_click и click_time для всех подходящих устройств
        foreach ($devicesToUpdate as $device) {
            $device->is_click = 1;
            $device->click_time = date('Y-m-d H:i:s'); // Устанавливаем текущее время

            // Создаем уведомление
            $notification = new Notification();
            $notification->user_id = $device->user_id;
            $notification->device_user_id = $device->id;
            $notification->message = "Ваше устройство включено: " . $device->device->name;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->is_read = 0;

            // Сохраняем уведомление
            $notification->save();

            // Сохраняем изменения устройства
            $device->save();
        }

        return $this->redirect(['index', 'id' => $id]);
    }


    public function actionDisableClick($id)
    {
        // Получаем все подключенные устройства для группы
        $connectedDeviceIds = GroupDeviceUser::find()->select('device_user_id')->where(['group_id' => $id])->column();

        // Проверяем, есть ли устройства с is_click = 0
        $hasInactiveDevices = DeviceUser::find()->where(['id' => $connectedDeviceIds, 'is_click' => 0])->exists();

        if (!$hasInactiveDevices) {
            // Если все устройства имеют is_click = 1, обновляем их
            DeviceUser::updateAll(['is_click' => 0, 'click_time' => null], ['id' => $connectedDeviceIds]);
        }

        return $this->redirect(['index', 'id' => $id]);
    }

}

