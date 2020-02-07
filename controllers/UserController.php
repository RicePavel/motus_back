<?php

namespace app\controllers;

use yii\rest\Controller;

use app\models\ApiLoginForm;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends Controller {
    
    public function actionLogin() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ApiLoginForm();
        $bodyParams = \Yii::$app->request->getBodyParams();
        $model->login = $bodyParams['login'];
        $model->password = $bodyParams['password'];

            $access_token = $model->login();
            if ($access_token) {
                return ["success" => true, "access_token" => $access_token];
            } else {
                return ["success" => false, "msg" => implode(',', $model->getErrorSummary(true))];
            }
        
    }
    
    
    
}
        
        

