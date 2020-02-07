<?php

namespace app\controllers;

use yii\rest\Controller;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

use yii\helpers\ArrayHelper;

class TaskController extends Controller {
    
    public function behaviors() {
        /*
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
         * 
         */
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticatior' => [
                'class'=> QueryParamAuth:: className (), // Implementing access token authentication
                'except'=> ['login'], /// There is no need to validate the access token method. Note the distinction between $noAclLogin
            ]
        ]);
    }
    
    public function actionList() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return "test";
    }
    
}



