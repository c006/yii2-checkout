<?php

namespace c006\checkout\controllers;

use c006\alerts\Alerts;
use c006\authorizeNet\assets\AppAuthorizeNet;
use c006\cart\assets\AppCartHelpers;
use c006\cart\models\Cart;
use c006\checkout\assets\AppCheckoutSession;
use c006\checkout\models\CheckoutItem;
use c006\checkout\models\CheckoutLink;
use c006\checkout\models\CheckoutOrder;
use c006\checkout\models\CheckoutShipping;
use c006\checkout\models\CheckoutTransaction;
use c006\checkout\models\form\Billing;
use c006\checkout\models\form\BillingBankTransfer;
use c006\checkout\models\form\BillingCreditCard;
use c006\checkout\models\form\Shipping;
use c006\common\assets\AppCommon;
use c006\core\assets\CoreHelper;
use c006\email\WidgetEmailer;
use c006\preferences\assets\AppPrefs;
use c006\user\assets\AppHelper;
use c006\user\models\form\Login;
use Yii;
use yii\web\Controller;

class CheckoutController extends Controller
{

    /** @var  $session \c006\checkout\assets\AppCheckoutSession */
    private $session;

    /**
     * @return \yii\web\Response
     */
    function init()
    {
        parent::init();
//        AppAsset::register($this->getView());

        $this->session = new AppCheckoutSession();
        $this->session->init();

        if (!Yii::$app->user->isGuest) {
            if ($this->session->get('email', 0) == FALSE) {
                $user = AppHelper::getUser(FALSE);
                $this->session->save('email', $user->email);
            }
        }

        if (sizeof(AppCartHelpers::getCartItems()) < 1) {
            Alerts::setAlertType(Alerts::ALERT_INFO);
            Alerts::setMessage("There are no items in the cart");
            Alerts::setCountdown(5);

            return $this->redirect('/cart');
        }

        if ($_SERVER['REQUEST_URI'] != '/checkout' && strlen($this->session->get('email', ' ')) < 3) {
            Alerts::setAlertType(Alerts::ALERT_INFO);
            Alerts::setMessage("You're session has timed out");
            Alerts::setCountdown(5);

            return $this->redirect('/cart');
        }

        if (FALSE) {
            foreach (Yii::$app->session as $session_name => $session_value) {
                if (!is_array($session_value)) {
                    echo $session_name . ' => ' . $session_value . PHP_EOL;
                }
            }
            exit;
        }
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        if ($this->session->get('email', 0)) {
            return $this->redirect('/checkout/2');
        }

        if (isset($_POST['Guest'])) {
            $this->session->save('is_guest', 1);
            $this->session->save('email', $_POST['Guest']['email']);

            return $this->redirect('/checkout/2');
        }

        if (isset($_POST['Login'])) {
            $model = new Login();
            $post = Yii::$app->request->post();

            if ($model->load($post)) {
                $session_id = session_id();
                if ($model->login()) {

                    AppCartHelpers::updateSessionId($session_id, session_id());

                    return $this->redirect('/checkout/2');
                } else {
                    Alerts::setMessage('Login failed, please try again');
                    Alerts::setAlertType(Alerts::ALERT_DANGER);
                }
            }
        }


        return $this->render('index', []);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function action2()
    {
        if ($this->session->get('email', 0) == FALSE) {
            return $this->redirect('/cart');
        }

        if (AppPrefs::getPreference('coupon_enabled') == FALSE) {
            return $this->redirect('/checkout/3');
        }

        $return_url = '/checkout/2';

        return $this->render('2-coupons', [
            'return_url' => $return_url,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function action3()
    {

        if ($this->session->get('email', 0) == FALSE) {
            return $this->redirect('/cart');
        }

        if (!AppCartHelpers::requiresShipping()) {
            return $this->redirect('/checkout/4');
        }

        if (isset($_POST['Shipping'])) {
            foreach ($_POST['Shipping'] as $key => $value) {
                $this->session->save('shipping.' . $key, ucwords($value));
            }

            if ($_POST['Shipping']['use_for_billing'] == "1") {
                $this->session->save('billing.cc_name', $this->session->get('shipping.first_name') . ' ' . $this->session->get('shipping.last_name'));
                $this->session->save('billing.cc_postal_code', $this->session->get('shipping.postal_code'));
                $this->session->save('billing.cc_country', $this->session->get('shipping.country'));
            }

            return $this->redirect('/checkout/4');
        }

        $model = new Shipping();
        foreach ($model->attributes as $key => $item) {
            $model->$key = $this->session->get('shipping.' . $key);
        }

        return $this->render('3-shipping',
            [
                'model' => $model,
            ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function action4()
    {

        if ($this->session->get('email', 0) == FALSE) {
            return $this->redirect('/cart');
        }

        if (isset($_POST['BillingCreditCard'])) {
            $this->session->save('transaction_type', '1');
            foreach ($_POST['BillingCreditCard'] as $key => $value) {
                $this->session->save('billing.' . $key, ucwords($value));
            }

            return $this->redirect('/checkout/5');
        }
        if (isset($_POST['BillingBankTransfer'])) {

            $this->session->save('transaction_type', '2');
            foreach ($_POST['BillingBankTransfer'] as $key => $value) {
                $this->session->save('billing.' . $key, ucwords($value));
            }

            return $this->redirect('/checkout/5');
        }


        $model_cc = new BillingCreditCard();
        foreach ($model_cc->attributes as $key => $item) {
            $model_cc->$key = $this->session->get('billing.' . $key);
        }
        $model_cc->cc_country = ($model_cc->cc_country) ? $model_cc->cc_country : 223;

        $model_bt = new BillingBankTransfer();
        foreach ($model_bt->attributes as $key => $item) {
            $model_bt->$key = $this->session->get('billing.' . $key);
        }


        return $this->render('4-billing',
            [
                'model_cc'         => $model_cc,
                'model_bt'         => $model_bt,
                'transaction_type' => $this->session->get('transaction_type'),
            ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function action5()
    {
        if ($this->session->get('email', 0) == FALSE) {
            return $this->redirect('/cart');
        }


        $response = FALSE;
        $cart = AppCartHelpers::getCartItems();

        $shipping = new Shipping();
        foreach ($shipping->attributes as $key => $item) {
            $shipping->$key = $this->session->get('shipping.' . $key);
        }

        $billing = FALSE;
        if ($this->session->get('transaction_type') == '1') {
            $billing = new BillingCreditCard();
        } else if ($this->session->get('transaction_type') == '2') {
            $billing = new BillingBankTransfer();
        } else {
            $response = TRUE;
        }

        if ($billing) {
            foreach ($billing->attributes as $key => $item) {
                $billing->$key = $this->session->get('billing.' . $key);
            }
        }


        if (isset($_POST['Checkout'])) {

            if (Yii::$app->session->id != $_POST['Checkout']) {
                Alerts::setAlertType(Alerts::ALERT_INFO);
                Alerts::setMessage("You're session has timed out");
                Alerts::setCountdown(5);

                return $this->redirect('/cart');
            }

            $cart = new AppCartHelpers();

            $order = new CheckoutOrder();
            $order->session_id = Yii::$app->session->id;
            $order->user_id = ($this->session->get('is_guest', 0)) ? Yii::$app->user->id : 0;
            $order->subtotal = $cart->getCartTotal();
            $order->shipping = 0.00;
            $order->tax = 0.00;
            $order->total = ($order->subtotal + $order->shipping + $order->tax + 0.00);

            /* Check transaction  */

            $authorizeNet = new AppAuthorizeNet();


            if ($this->session->get('transaction_type') == '1') {
                $response = $authorizeNet->actionCreditCard($billing, $order->total, strtoupper(CoreHelper::formatUrl(AppPrefs::getPreference('store_name'))));
            }
            if ($this->session->get('transaction_type') == '2') {
                $response = $authorizeNet->actionBankTransfer($billing, $order->total);
            }

            if ($response != FALSE) {

                $trans_fee = 0.00;
                $trans_desc = "Remote IP: " . $_SERVER['REMOTE_ADDR'];



                if (!$order->save()) {
                    echo "checkout_orders" . PHP_EOL;
                    print_r($order->getErrors());
                    exit;
                }

                $checkout_transaction = new CheckoutTransaction();
                $checkout_transaction->order_id = $order->id;
                $checkout_transaction->amount = $response['amount'];
                $checkout_transaction->transaction_type_id = $this->session->get('transaction_type', 0);
                $checkout_transaction->transaction_id = $response['transaction_id'];
                $checkout_transaction->auth = $response['auth'];
                $checkout_transaction->fee = $trans_fee;
                $checkout_transaction->description = $trans_desc;
                $checkout_transaction->timestamp = time();
                if (!$checkout_transaction->save()) {
                    echo "checkout_transaction" . PHP_EOL;
                    print_r($checkout_transaction->getErrors());
                    exit;
                }

                if ($shipping['address']) {
                    $checkout_shipping = new CheckoutShipping();
                    $checkout_shipping->order_id = $order->id;
                    $checkout_shipping->first_name = $shipping['first_name'];
                    $checkout_shipping->last_name = $shipping['last_name'];
                    $checkout_shipping->address = $shipping['address'];
                    $checkout_shipping->address2 = $shipping['address2'];
                    $checkout_shipping->city = $shipping['city'];
                    $checkout_shipping->state = $shipping['state'];
                    $checkout_shipping->postal_code = $shipping['postal_code'];
                    $checkout_shipping->country = $shipping['country'];
//            print_r($checkout_shipping); exit;
                    if (!$checkout_shipping->save()) {
                        echo "checkout_shipping" . PHP_EOL;
                        print_r($checkout_shipping->getErrors());
                        exit;
                    }
                }

                foreach ($cart->getCartItems() as $item) {
                    $checkout_item = new CheckoutItem();
                    $checkout_item->order_id = $order->id;
                    $checkout_item->product_id = $item['product_id'];
                    $checkout_item->product_shipping_id = $item['shipping_id'];
                    $checkout_item->quantity = $item['quantity'];
                    $checkout_item->discount = $item['discount'];
                    $checkout_item->price = $item['price'];
                    if (!$checkout_item->save()) {
                        echo "checkout_item" . PHP_EOL;
                        print_r($checkout_item->getErrors());
                        exit;
                    }

                    $checkout_link = new CheckoutLink();
                    $checkout_link->order_id = $order->id;
                    $checkout_link->item_id = $checkout_item->id;
                    $checkout_link->shipping_id = ($shipping['address']) ? $checkout_shipping->id : 0;
                    if (!$checkout_link->save()) {
                        echo "checkout_link" . PHP_EOL;
                        print_r($checkout_link->getErrors());
                        exit;
                    }
                }

                $this->session->save('order_id', $order->id);

                /* TODO: C006 Checkout - Email Invoice */

                $order_items = '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                $order_items .= '<tr>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Model</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Name</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Price</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Qty</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Total</td>';
                $order_items .= '</tr>';

                foreach (AppCartHelpers::getCartItems() as $item) {
                    $order_items .= '<tr>';
                    $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . $item['model'] . '</td>';
                    $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . $item['name'] . '</td>';
                    $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . $item['price'] . '</td>';
                    $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . $item['quantity'] . '</td>';
                    $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . number_format(($item['price'] * $item['quantity']), 2) . '</td>';
                    $order_items .= '</tr>';
                }

                $order_items .= '<tr>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Shipping</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . number_format($order->shipping, 2) . '</td>';
                $order_items .= '</tr>';

                $order_items .= '<tr>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">Tax</td>';
                $order_items .= '<td valign="middle" style="padding: 5px; border-bottom: 1px solid #999999">' . number_format($order->tax, 2) . '</td>';
                $order_items .= '</tr>';

                $order_items .= '<tr>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;"></td>';
                $order_items .= '<td valign="middle" style="padding: 5px;">Total</td>';
                $order_items .= '<td valign="middle" style="padding: 5px;">' . number_format($order->total, 2) . '</td>';
                $order_items .= '</tr>';

                $order_items .= '</table>';


                /* Billing */
                $order_billing = '';
                if ($billing) {
                    if ($this->session->get('transaction_type') == 1) {
                        $order_billing .= '<div>' . ucwords($billing->cc_name) . '</div>';
                        $order_billing .= '<div>****' . substr($billing->cc_number, -4) . '</div>';
                        $order_billing .= '<div>' . substr("00" . $billing->cc_exp_month, -2) . '/' . substr($billing->cc_exp_year, -2) . '</div>';
                        $order_billing .= '<div>' . $billing->cc_postal_code . ', ' . AppCommon::getCountry($billing->cc_country)['char2'] . '</div>';
                    } elseif ($this->session->get('transaction_type') == 2) {
                        $order_billing .= '<div>' . $billing->bt_bank . '</div>';
                        $order_billing .= '<div>' . $billing->bt_name . '</div>';
                        $order_billing .= '<div>****' . substr($billing->bt_account, -4) . '</div>';
                    }
                }

                /* Shipping */
                $order_shipping = '';
                if ($shipping['address']) {
                    $order_shipping .= '<div>' . $shipping->first_name . ' ' . $shipping->last_name . '</div>';
                    $order_shipping .= '<div>' . $shipping->address . '</div>';
                    if ($shipping->address2) {
                        $order_shipping .= '<div>' . $shipping->address2 . '</div>';
                    }
                    $order_shipping .= '<div>' . $shipping->state . ', ' . $shipping->postal_code . '</div>';
                    $order_shipping .= '<div>' . $shipping->country . '</div>';
                }


                $array = [];
                $array['subject'] = Yii::$app->params['siteName'] . ' : Order: ' . $order->id;
                $array['main_header'] = AppPrefs::getPreference('store_name');
                $array['sub_header'] = 'Thank you for your order';
                $array['order_billing'] = $order_billing;
                $array['order_shipping'] = $order_shipping;
                $array['order_items'] = $order_items;
                $array['email_to'] = $this->session->get('email');

                WidgetEmailer::widget(['template_id' => 5, 'array' => $array]);

                return $this->redirect('success');
            }
        }

        return $this->render('5-summary',
            [
                'cart'             => $cart,
                'shipping'         => $shipping,
                'billing'          => $billing,
                'transaction_type' => $this->session->get('transaction_type', 0),
            ]);
    }

    /**
     * @return string
     */
    public function actionSuccess()
    {
        $array = [];
        $array['order_id'] = $this->session->get('order_id');
        $array['email'] = $this->session->get('email');

        AppCartHelpers::destroyCart();
        $this->session->destroy();
        Yii::$app->session->destroy();

        return $this->render('6-success',
            [
                'array' => $array,

            ]);
    }


}
