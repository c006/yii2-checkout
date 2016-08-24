<?php


namespace c006\checkout\controllers;


use c006\cart\assets\AppCartHelpers;
use c006\common\assets\AppCommon;
use c006\shipping\assets\AppHelper;
use Yii;
use yii\web\Controller;

class AjaxController extends Controller
{

    /**
     * @param $country
     * @param $postal_code
     * @return string
     */
    public function actionShipping($country, $postal_code)
    {
        $array = [];

        $subtotal = AppCartHelpers::getCartTotal();

        $address = AppCommon::getAddress($postal_code, $country);

        $zone_id = AppHelper::getShippingZoneByCode($country, $address['state_2']);

        $zones = AppHelper::getShippingRuleZones($zone_id['id']);

        foreach ($zones as $item) {
            $rule = AppHelper::getShippingRule($item['shipping_rule_id']);
            if ($rule['min_subtotal'] <= $subtotal && ($rule['max_subtotal'] == 0.00 || $rule['max_subtotal'] <= $subtotal)) {
                $array[$rule['position']] = $rule;
            }
        }

        return json_encode($array);
    }


}