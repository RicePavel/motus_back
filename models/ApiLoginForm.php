<?php

namespace app\models;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;
use yii\base\Model;

use app\models\ar\User;

class ApiLoginForm extends Model {
    
    public $login;
    public $password;
    
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required']
        ];
    }
    
    public function login() {
        if ($this->validate()) {
            $users = User::find()->where(['login' => $this->login])->all();
            if (count($users) > 1) {
                $this->addError("password", "authorization error");
                return "";
            } else if (count($users) < 1) {
                $this->addError("password", "incorrect username or password");
                return "";
            } else if (count($users) == 1) { 
                    $user = $users[0];
                    $hash = md5($this->password);
                    if ($hash == $user->password) {
                        $access_token = $user->generateAccessToken();
                        $user->save();
                        $ok = Yii::$app->user->login($user);
                        return $access_token;
                    } else {
                        $this->addError("password", "incorrect password");
                    }
            }
        }
        return "";
    }
    
}
