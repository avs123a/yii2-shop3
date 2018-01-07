<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Cart';
?>
<div class="cart_view" style="min-height:400px;">
    <div class="cart_list">
	    <div class="row">
	        <div class="col-xs-3"><strong>Title</strong></div>
			<div class="col-xs-2"><strong>Price</strong></div>
			<div class="col-xs-3"><strong>Quantity</strong></div>
			<div class="col-xs-2"></div>
		</div>
	 
        <?php foreach($model as $key => $value): ?>
	    <div class="row" style="min-height:100px;">
		    <div class="col-xs-3"><?=$value['title'] ?></div>
			<div class="col-xs-2"><?php if($value['item_id']!=null): ?>$<?=$value['price'] ?><?php endif; ?></div>
			<div class="col-xs-3"><?php if($value['item_id']!=null): ?><?php if($value['quantity']>1) echo Html::a(' <strong>-</strong> ',['cart/update-item','id'=>$value['item_id'],'option1'=>'reduce'], ['class' => 'btn btn-default']); echo $value['quantity']; if($value['quantity']<$value['avquantity']) echo Html::a(' <strong>+</strong> ',['cart/update-item','id'=>$value['item_id'],'option1'=>'add'], ['class' => 'btn btn-default']); ?> (<?=$value['avquantity'] ?> available) <?php endif; ?></div>
			<div class="col-xs-2"><?php if($value['item_id']!=null) echo Html::a('<button type="button" style="background-color:#ff0000;color:#ffffff">x</button>', ['cart/delete-item', 'item_id' => $value['item_id']]) ?></div>
		</div>
        <?php endforeach; ?>
		
		
		<?= Html::a('Order', ['cart/order'], ['class' => 'btn btn-default', 'style' => 'color:#ffffff;background-color:#ff9900']); ?>
	</div>
</div>