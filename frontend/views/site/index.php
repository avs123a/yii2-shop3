<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<!-- main-slider -->
		<?=Html::img(\backend\controllers\SiteController::getBannerUrl(1)) ?>
	<!-- //main-slider -->


<!-- new -->
	<div class="newproducts-w3agile">
		<div class="container">
			<h3>New offers</h3>
				<div class="agile_top_brands_grids">
				<?php foreach($new_products as $newoffer): ?>
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