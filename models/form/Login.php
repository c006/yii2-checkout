<?php

namespace c006\checkout\models\form;


use Yii;
use yii\base\Model;

class Login extends Model
{

    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['password'], 'required'],
        ];
    }

}
