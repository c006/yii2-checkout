<?php

namespace c006\checkout\assets;

use Yii;

class AppCheckoutSession
{

    private $session;
    private $items = [
        'is_guest'                 => 0,
        'email'                    => '',
        'shipping.first_name'      => '',
        'shipping.last_name'       => '',
        'shipping.address'         => '',
        'shipping.address2'        => '',
        'shipping.city'            => '',
        'shipping.state'           => '',
        'shipping.postal_code'     => '',
        'shipping.country'         => 223,
        'shipping.use_for_billing' => 1,
        'shipping.shipping'        => 0,
        'billing.cc_name'          => '',
        'billing.cc_number'        => '',
        'billing.cc_exp_month'     => '',
        'billing.cc_exp_year'      => '',
        'coupon'                   => [],
    ];


    function init()
    {
        $this->session = Yii::$app->session;
        if ($this->session->isActive == FALSE) {
            $this->session->open();
        }
        foreach ($this->items as $key => $value) {
            $this->session[$key] = ($this->session->has($key)) ? $this->session[$key] : $value;
        }
    }

    public function save($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function get($key, $default_value = '')
    {
        return ($this->session->has($key)) ? $this->session[$key] : $default_value;
    }

    public function destroy()
    {
        Yii::$app->session->destroy();
    }
}