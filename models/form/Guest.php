<?php

namespace c006\checkout\models\form;


use Yii;
use yii\base\Model;

class Guest extends Model
{

    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

}
