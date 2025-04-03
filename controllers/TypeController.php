<?php

namespace app\controllers;

use app\models\Type;
use yii\web\Controller;

class TypeController extends Controller
{
    public function actionIndex()
    {
        $type = Type::find()->all();
        $context = [
            'type'=>$type,
        ];
        return $this->render('index', $context);
    }

}
