<?php

namespace c006\checkout\models\form;

use Yii;
use yii\base\Model;

class BillingBankTransfer extends Model
{

    public $bt_name;
    public $bt_bank;
    public $bt_routing;
    public $bt_account;

    public function rules()
    {
        return [
            [['bt_name'], 'required'],
            [['bt_bank'], 'required'],
            [['bt_routing'], 'required'],
            [['bt_account'], 'required'],
        ];
    }

}
