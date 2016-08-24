<?php

namespace c006\checkout\models\form;

use Yii;
use yii\base\Model;

class Shipping extends Model
{

    public $first_name;
    public $last_name;
    public $address;
    public $address2;
    public $city;
    public $state;
    public $postal_code;
    public $country;
    public $email;
    public $use_for_billing;
    public $shipping;

    public function rules()
    {
        return [
            [['first_name'], 'required'],
            [['last_name'], 'required'],
            [['address'], 'required'],
            [['city'], 'required'],
            [['postal_code'], 'required'],
            [['postal_code'], 'number'],
            [['email'], 'email'],
        ];
    }

}
