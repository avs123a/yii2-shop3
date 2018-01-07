<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'title',
            'description:ntext',
            'price',
            'quantity',
        ],
    ]) ?>
	
	<?php $form = ActiveForm::begin([
	    'options' => ['enctype' => 'multipart/form-data'],
    ]) ?>
	
	<?=$form->field($upload_form, 'newfile1')->fileInput(['multiple' => false]) ?>
	
	<?=Html::submitButton('Upload Image', ['class' => 'btn btn-info']) ?>
	
	<?php ActiveForm::end(); ?>
	
	<?=Html::img(\common\models\Product::getProductImageUrl($model->id, $model->title)) ?>
	
</div>
