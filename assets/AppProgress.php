<?php

namespace c006\checkout\assets;


use Yii;

class AppProgress
{

    /**
     * @return array
     */
    static public function progress()
    {
        $progress = [1, 0, 0, 0, 0, 0];
        if (Yii::$app->session->get('progress', 0) == FALSE) {
            Yii::$app->session->set('progress', $progress);
        } else {
            $progress = Yii::$app->session->get('progress', $progress);
        }

        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        $uri = $uri[sizeof($uri) - 1];

        $array = [
            ['url' => '/checkout', 'progress' => 1, 'alt' => 'Login'],
            ['url' => '/checkout/2', 'progress' => 0, 'alt' => 'Coupon'],
            ['url' => '/checkout/3', 'progress' => 0, 'alt' => 'Address'],
            ['url' => '/checkout/4', 'progress' => 0, 'alt' => 'Payment'],
            ['url' => '/checkout/5', 'progress' => 0, 'alt' => 'Summary'],
            ['url' => '/checkout/6', 'progress' => 0, 'alt' => 'Confirmation'],];

        foreach ($array as $index => $item) {
            $n = preg_replace('/[^0-9]/', '', $item['url']);
            if ($n == $uri) {
                $array[$index]['progress'] = 2;
                $progress[$index] = 2;
            } else if ($progress[$index]) {
                $array[$index]['progress'] = 1;
                $progress[$index] = 1;
            }
        }
        Yii::$app->session->set('progress', $progress);

        return $array;
    }


}