<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to admin panel</h1>

        <p class="lead">Short statistics</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Users</h2>

                <p><?=$user_count ?></p>

            </div>
            <div class="col-lg-4">
                <h2>Products</h2>

                <p><p><?=$product_count ?></p></p>
            </div>
            <div class="col-lg-4">
                <h2>Orders</h2>

                <p><p><?=$order_count ?></p></p>
            </div>
        </div>
    </div>
	
	<div class="row">
	    <h3>Slider Banners</h3>
		    <p>Banner1</p>
			<?php $form1 = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
			
			<?=$form1->field($upload_banner1, 'newfile1')->fileInput(['multiple' => false]) ?>
			
			<?=Html::submitButton('Upload Banner', ['class' => 'btn btn-info']) ?>
			
	        <?php ActiveForm::end(); ?>
			
			<?=Html::img(\backend\controllers\SiteController::getBannerUrl(1), ['height' => 400]) ?>
	</div>
	
</div>
