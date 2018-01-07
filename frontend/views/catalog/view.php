<?php

use yii\helpers\Html;

$this->title = 'Product Info';
?>
<div class="products">
		<div class="container">
			<div class="agileinfo_single">
				
				<div class="col-md-4 agileinfo_single_left">
					<?=Html::img(\common\models\Product::getProductImageUrl($model->id, $model->title), ['class' => 'img-responsive']) ?>
				</div>
				<div class="col-md-8 agileinfo_single_right">
				<h2><?=$model->title ?></h2>
					<div class="w3agile_description">
						<h4>Description :</h4>
						<p><?=$model->description ?></p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4 class="m-sing"><?php if(\Yii::$app->user->isGuest): ?>$<?=$model->price ?><?php else: ?>$<?=$model->price*0.75 ?> <span>$<?=$model->price ?></span><?php endif; ?></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<fieldset>
								<?=Html::a('Add to cart', ['cart/add', 'id' => $model->id], ['class' => 'button']) ?>
							</fieldset>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- new -->
	<div class="newproducts-w3agile">
		<div class="container">
			<h3>New offers</h3>
				<div class="agile_top_brands_grids">
				<?php foreach($new_offers as $newoffer): ?>
					<div class="col-md-3 top_brand_left-1">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
									<img src="images/offer.png" alt=" " class="img-responsive">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<?=Html::a('<img src='.\common\models\Product::getProductImageUrl($newoffer['id'], $newoffer['title']).'></img>', ['catalog/view', 'id' => $newoffer['id']]) ?>	
												<p><?=$newoffer['title'] ?></p>
												
													<h4><?php if(\Yii::$app->user->isGuest): ?>$<?=$newoffer['price'] ?><?php else: ?>$<?=$newoffer['price']*0.75 ?> <span>$<?=$newoffer['price'] ?></span><?php endif; ?></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<fieldset>
													<?=Html::a('Add to cart', ['cart/add', 'id' => $newoffer['id']], ['class' => 'button']) ?>
												</fieldset>
											</div>
										</div>
									</figure>
								</div>
							</div>
						</div>
					</div>
                <?php endforeach; ?>
						<div class="clearfix"> </div>
				</div>
		</div>
	</div>
<!-- //new -->
