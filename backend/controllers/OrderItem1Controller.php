<?php

namespace backend\controllers;

use Yii;
use common\models\OrderItem1;
use backend\models\OrderItem1Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrderItemController implements the CRUD actions for OrderItem model.
 */
class OrderItem1Controller extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
		    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
                            return \common\models\User::isAdmin(Yii::$app->user->identity->email);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    


    /**
     * Deletes an existing OrderItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$orderId = $this->findModel($id)->order_id;
        $this->findModel($id)->delete();

        return $this->redirect(['//order/view', 'id' => $orderId]);
    }

    /**
     * Finds the OrderItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderItem1::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
