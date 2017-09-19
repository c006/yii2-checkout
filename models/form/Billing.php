<?php

namespace c006\checkout\models\form;

use Yii;
use yii\base\Model;

class Billing extends Model
{

    public $first_name;
    public $last_name;
    public $cc_postal_code;
    public $cc_country;
    public $cc_name;
    public $cc_number;
    public $cc_exp_month;
    public $cc_exp_year;
    public $cvv;

    public function rules()
    {
        return [
            [['cc_name'], 'required'],
            [['cc_number'], 'required'],
            [['cc_number'], 'integer'],
            [['cc_exp_month'], 'required'],
            [['cc_exp_month'], 'integer'],
            [['cc_exp_year'], 'required'],
            [['cc_exp_year'], 'integer'],
            [['cc_postal_code'], 'required'],
            [['cc_postal_code'], 'integer'],
            [['cc_country'], 'required'],
            [['cc_country'], 'integer'],
            [['cvv'], 'required'],
            [['cvv'], 'integer'],
        ];
    }

}
