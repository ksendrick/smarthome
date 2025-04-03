<?php

namespace app\controllers;

use app\models\DeviceUser;
use app\models\Notification;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class NotificationsController extends Controller
{
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        $devices = DeviceUser::find()
            ->where(['user_id' => $userId])
            ->andWhere(['status' => 2])
            ->all();

        $notifications = Notification::find()
            ->where(['user_id' => $userId])
            ->all();

        $filteredNotifications = [];
        $currentTime = date('Y-m-d H:i:s');


        foreach ($notifications as $notification) {

            $notificationTime = date('Y-m-d H:i:s', strtotime($notification->created_at . ' +50 seconds'));

            if ($notificationTime < $currentTime) {
                $filteredNotifications[] = $notification;
            }
        }

        return $this->render('index', [
            'devices' => $devices,
            'notifications' => $filteredNotifications,
        ]);
    }

    public function actionCheckUnread()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->user->id;

        $hasUnreadDeviceUser = DeviceUser::find()
            ->where(['user_id' => $userId])
            ->andWhere(['status' => 2])
            ->andWhere(['is', 'read_at', null])
            ->exists();

        $currentTime = date('Y-m-d H:i:s');

        $hasUnreadNotification = Notification::find()
            ->where(['user_id' => $userId])
            ->andWhere(['is_read' => 0])
            ->all();

        $hasValidUnreadNotification = false;

        foreach ($hasUnreadNotification as $notification) {
            $notificationTime = date('Y-m-d H:i:s', strtotime($notification->created_at . ' +50 seconds'));

            if ($notificationTime < $currentTime) {
                $hasValidUnreadNotification = true;
                break;
            }
        }

        return [
            'hasUnreadDeviceUser' => $hasUnreadDeviceUser,
            'hasValidUnreadNotification' => $hasValidUnreadNotification,
        ];
    }


    public function actionMarkAsRead($id)
    {
        $deviceUser = DeviceUser::findOne($id);
        if ($deviceUser) {
            $deviceUser->read_at = date('Y-m-d H:i:s');
            $deviceUser->save();
        }
        return $this->redirect(['site/device', 'id' => $deviceUser->id]);
    }

    public function actionRead($id)
    {
        $notification = Notification::findOne($id);
        if ($notification) {
            $notification->is_read = 1;
            $notification->save();
        }
        return $this->redirect(['site/device', 'id' => $notification->device_user_id]);
    }

    public function actionMarkAllAsRead()
    {
        $userId = Yii::$app->user->id;

        Notification::updateAll(['is_read' => 1], ['user_id' => $userId, 'is_read' => 0]);
        DeviceUser::updateAll(['read_at' => date('Y-m-d H:i:s')], ['user_id' => $userId, 'read_at' => null]);

        Yii::$app->session->setFlash('success', 'Все уведомления отмечены как прочитанные.');
        return $this->redirect(['index']);
    }
}
