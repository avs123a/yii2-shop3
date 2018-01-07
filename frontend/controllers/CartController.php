<?php
namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Product;
use common\models\Order;
use common\models\OrderItem1;
use common\models\User;
use yii\web\Controller;

class CartController extends Controller
{
	//adding to cart
	public function actionAdd($id)
	{
		$product = Product::findOne($id);
		$cart = Yii::$app->session;
		
		$user_price = null;
		if(Yii::$app->user->isGuest){
			$user_price = $product->price;
		}else{
			$user_price = $product->price*0.75;
		}
		
		$cart["shop_item_$id"] = [
		    'item_id' => $id,
			'title' => $product->title,
			'price' => $user_price,
			'quantity' => 1,
			'avquantity' => $product->quantity,
		];
		
		Yii::$app->session->addFlash('success', 'You have added product in your cart');
		return $this->redirect(['catalog/list', 'category_title' => Category::findOne($product->category_id)->title]);
	}
	
	//show cart
	public function actionList()
	{
		$model = Yii::$app->session;
		
		return $this->render('list',[
		    'model' => $model,
		]);
	}
	
	//update item
	public function actionUpdateItem($id, $option1)
	{
		$cart = Yii::$app->session;
		$item = $cart["shop_item_$id"];
		switch($option1)
		{
			case 'add': ++$item['quantity'];
			break;
			case 'reduce': --$item['quantity'];
			break;
		}
		$cart["shop_item_$id"] = $item;
		
		return $this->redirect(['cart/list']);
		
	}
	
	//delete item
	public function actionDeleteItem($item_id)
	{
		$cart = Yii::$app->session;
		$cart->remove("shop_item_$item_id");
		
		return $this->redirect(['cart/list']);
	}
	
	//place order
	public function actionOrder()
	{
		$model = new Order();
		
		$cart = Yii::$app->session;
		
		
		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			foreach($cart as $key => $value){
				if($value['item_id']!=null){
				    $item1 = new OrderItem1();
				    $item1->order_id = $model->id;
					$item1->title = $value['title'];
					$item1->price = $value['price'];
				    $item1->quantity = $value['quantity'];
					//$item->save();
					if($item1->save()){
						$cart->remove('shop_item_'.$value['item_id']);
					}else{
						//throw new HttpException();
						Yii::$app->session->addFlash('error', 'Item saving error!!!'.$item1->getErrors());
					}
				}
			}
			Yii::$app->session->addFlash('success', 'Thanks for your order. We will contact to you.');
			return $this->redirect(['//site/index']);
			
		}
		else
		{
			return $this->render('order', [
			    'model' => $model,
			    'cart' => $cart,
			]);
		}
		
	}
	
}