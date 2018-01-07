<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use common\models\LoginForm;
use backend\models\UploadForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
						
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$user_count = (new \yii\db\Query())->select('id')->from('user')->count()-1;
		$product_count = (new \yii\db\Query())->select('id')->from('product')->count();
		$order_count = (new \yii\db\Query())->select('id')->from('order')->count();
		
		$form1 = new UploadForm();
		
		if(Yii::$app->request->isPost){
			$form1->newfile1 = UploadedFile::getInstance($form1, 'newfile1');
			
			if($form1->newfile1 && $form1->validate())
			{
				$form1->newfile1->saveAs(static::getBannerPath(1));
				Yii::$app->session->addFlash('success', 'Slider 1 was uploaded successfuly.');
			}
			
		}
		
		
        return $this->render('index', [
		    'user_count' => $user_count,
		    'product_count' => $product_count,
		    'order_count' => $order_count,
			'upload_banner1' => $form1,
		]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public static function getBannerPath($num)
	{
		return Yii::getAlias('@backend/web/banners/mainbanner_'.$num.'.png');
	}
	
	public static function getBannerUrl($num)
	{
		return Yii::getAlias('@backendWebroot/banners/mainbanner_'.$num.'.png');
	}
	
}
