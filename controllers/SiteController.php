<?php

namespace app\controllers;

use app\models\Device;
use app\models\DeviceUser;
use app\models\DeviceUserForm;
use app\models\Group;
use app\models\LightingScenarios;
use app\models\Notification;
use app\models\RegisterForm;
use app\models\Scenario;
use app\models\ScenarioUser;
use app\models\Type;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $type = Type::find()->all();
        $context = [
            'type'=>$type,
        ];
        return $this->render('index', $context);
    }

    public function actionProfile()
    {
        $query = DeviceUser::find()->where(['user_id' => Yii::$app->user->id]);
        $count = $query->count();
        $group = Group::find()->where(['user_id'=>Yii::$app->user->id])->all();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $count,
        ]);


        $device_user = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $scenario_user = ScenarioUser::find()->where(['user_id'=>Yii::$app->user->id])->all();
        $scenario = Scenario::find()->all();

        $context = [
            'device_user' => $device_user,
            'scenario' => $scenario,
            'scenario_user' => $scenario_user,
            'pagination' => $pagination,
            'group'=>$group
        ];

        return $this->render('profile', $context);
    }

    public function actionDevice($id) {
        $device_user = DeviceUser ::findOne($id);
        $model = new DeviceUser();

        if ($device_user) {
            $model->user_id = $device_user->user_id;
            $model->device_id = $device_user->device_id;
            $model->time_on = $device_user->time_on;
            $model->time_off = $device_user->time_off;
            $model->is_click = $device_user->is_click;
            $model->status = $device_user->status;

            if ($this->request->isPost && $model->load($this->request->post())) {
                $device_user->attributes = $model->attributes;

                if ($device_user->is_click == 1) {
                    $device_user->click_time = date('Y-m-d H:i:s');

                    $notification = new Notification();
                    $notification->user_id = $device_user->user_id;
                    $notification->device_user_id = $device_user->id;
                    $notification->message = "Ваше устройство следует выключить " . $device_user->device->name;
                    $notification->created_at = date('Y-m-d H:i:s');
                    $notification->is_read = 0;

                    $notification->save();


                } else {
                    $device_user->click_time = null;
                }

                if ($device_user->save()) {
                    return $this->redirect(['site/device', 'id' => $id]);
                }
            }
        }

        return $this->render('device', [
            'device_user' => $device_user,
            'model' => $model,
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->is_admin){
                return $this->redirect('/admin');
            }else{
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $user = $model->register()) {
            if (Yii::$app->user->login($user)) {
                return $this->goHome();
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
