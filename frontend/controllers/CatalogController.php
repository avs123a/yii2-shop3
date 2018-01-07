<?php
namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Product;
use yii\web\Controller;
use yii\data\Pagination;

class CatalogController extends Controller
{
	
	public function actionList($category_title)
	{
		$categories = (new \yii\db\Query())->select(['id', 'title'])->from('category')->where(['parent_id' => null])->all();
		$selected_category = null;
		$products = null;
		
		if($category_title == 'Store')
		{
			$selected_category['title'] = 'Store';
			$products = Product::find()->where(['not', ['quantity' => 0]]);
			
			//global search
			if($gsearch = Yii::$app->request->get('GlSearch')){
				$products->andFilterWhere(['like', 'title', $gsearch])->orFilterWhere(['like', 'description', $gsearch]);
			}
			
		}
		else
		{
		    $selected_category = Category::findOne(['title' => $category_title]);
		    $products = $selected_category->getProducts()->where(['not', ['quantity' => 0]]);
			
		}
		
		
		
		
		//pagination variants
		$pagesize = null;
		
		if($pagesize1 = Yii::$app->request->get('item_page')){
			switch($pagesize1)
			{
			    case 'item9': $pagesize = 9;
				break;
				case 'item18': $pagesize = 18;
				break;
				case 'item33': $pagesize = 33;
				break;
			}
			
		}else{
			$pagesize = 9;
		}
		
		$pagination = new Pagination(['defaultPageSize' => $pagesize, 'totalCount' => $products->count()]);
		
		
		//sort
		$sort = null;
		
		if($sort = Yii::$app->request->get('selected_sort')){
			switch($sort)
			{
				case 'default': $model = $products->indexBy('id')->orderBy('id')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
				break;
				case 'low_to_high_pr': $model = $products->indexBy('id')->orderBy('price')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
				break;
				case 'high_to_low_pr': $model = $products->indexBy('id')->orderBy('price DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
				break;
			}
		}else{
			$sort = 'default';
			$model = $products->indexBy('id')->orderBy('id')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		}
		
		
		
		
		
		return $this->render('list',[
		    'selected_category' => $selected_category,
			'products' => $model,
			'categories' => $categories,
			'pagination' => $pagination,
			'sort' => $sort,
			'pagesize' => $pagesize,
		]);
	}
	
	
	public function actionView($id)
	{
	    $model = Product::findOne($id);
		
		$new_offers = (new \yii\db\Query())->select(['id', 'title', 'price'])->from('product')->where(['category_id' => $model->category_id])->orderBy('id DESC')->limit(4)->all();
		
		return $this->render('view', [
	        'model' => $model,
			'new_offers' => $new_offers,
		]);
	}
	
}