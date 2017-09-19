<?php

namespace c006\checkout\controllers;

use Yii;
use c006\checkout\models\CheckoutLink;
    use c006\checkout\models\search\CheckoutLink as CheckoutLinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* CheckoutLinkController implements the CRUD actions for CheckoutLink model.
*/
class CheckoutLinkController extends Controller
{
public function behaviors()
{
return [
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [
'delete' => ['post'],
],
],
];
}

/**
* Lists all CheckoutLink models.
* @return mixed
*/
public function actionIndex()
{
    $searchModel = new CheckoutLinkSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single CheckoutLink model.
* @param integer $order_id
     * @param integer $item_id
     * @param integer $shipping_id
* @return mixed
*/
public function actionView($order_id, $item_id, $shipping_id)
{
return $this->render('view', [
'model' => $this->findModel($order_id, $item_id, $shipping_id),
]);
}

/**
* Creates a new CheckoutLink model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new CheckoutLink();

if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['view', 'order_id' => $model->order_id, 'item_id' => $model->item_id, 'shipping_id' => $model->shipping_id]);
} else {
return $this->render('create', [
'model' => $model,
]);
}
}

/**
* Updates an existing CheckoutLink model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $order_id
     * @param integer $item_id
     * @param integer $shipping_id
* @return mixed
*/
public function actionUpdate($order_id, $item_id, $shipping_id)
{
$model = $this->findModel($order_id, $item_id, $shipping_id);

if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['view', 'order_id' => $model->order_id, 'item_id' => $model->item_id, 'shipping_id' => $model->shipping_id]);
} else {
return $this->render('update', [
'model' => $model,
]);
}
}

/**
* Deletes an existing CheckoutLink model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param integer $order_id
     * @param integer $item_id
     * @param integer $shipping_id
* @return mixed
*/
public function actionDelete($order_id, $item_id, $shipping_id)
{
$this->findModel($order_id, $item_id, $shipping_id)->delete();

return $this->redirect(['index']);
}

/**
* Finds the CheckoutLink model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param integer $order_id
     * @param integer $item_id
     * @param integer $shipping_id
* @return CheckoutLink the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($order_id, $item_id, $shipping_id)
{
if (($model = CheckoutLink::findOne(['order_id' => $order_id, 'item_id' => $item_id, 'shipping_id' => $shipping_id])) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
