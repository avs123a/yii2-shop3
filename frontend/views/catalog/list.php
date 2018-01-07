<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

//$this->title = $

?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><?=Html::a('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home', ['site/index']) ?></li>
				<li class="active"><?=$selected_category['title'] ?></li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->

<!--- groceries --->
	<div class="products">
		<div class="container">
			<div class="col-md-4 products-left">
				<div class="categories">
					<h2>Categories</h2>
					<ul class="cate">
					<?php foreach($categories as $category): ?>
						<li><?=Html::a('<i class="fa fa-arrow-right" aria-hidden="true"></i>'.$category['title'], ['catalog/list', 'category_title' => $category['title']]) ?></li>
							<ul>
							<?php foreach(\common\models\Category::getCategories($category['id']) as $subcategory): ?>
								<li><?=Html::a('<i class="fa fa-arrow-right" aria-hidden="true"></i>'.$subcategory['title'], ['catalog/list', 'category_title' => $subcategory['title']]) ?></li>
							<?php endforeach; ?>
							</ul>
					<?php endforeach; ?>
					</ul>
				</div>																																												
			</div>
			<div class="col-md-8 products-right">
				<div class="products-right-grid">
					<div class="products-right-grids">
						<div class="sorting">
						<?=Html::beginForm(['catalog/list', 'category_title' => $selected_category['title']], 'get') ?>
							<select id="country" name="selected_sort" onchange="form.submit()" class="frm-field required sect">
							<?php switch($sort){
								case 'default': echo '
								<option value="default" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
								<option value="low_to_high_pr"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (low to high)</option>								
							    <option value="high_to_low_pr"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (high to low)</option>
								'; break;
								case 'low_to_high_pr': echo '
								<option value="default"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
								<option value="low_to_high_pr" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (low to high)</option>								
							    <option value="high_to_low_pr"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (high to low)</option>
								'; break;
								case 'high_to_low_pr': echo '
								<option value="default"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
								<option value="low_to_high_pr"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (low to high)</option>								
							    <option value="high_to_low_pr" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price (high to low)</option>
								'; break;
							} ?>
							</select>
						<?=Html::endForm(); ?>
						</div>
						<div class="sorting-left">
						<?=Html::beginForm(['catalog/list', 'category_title' => $selected_category['title']], 'get') ?>
							<select id="country1" name="item_page" onchange="form.submit()" class="frm-field required sect">
							<?php switch($pagesize){
								case 9: echo '
								<option value="item9" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
								<option value="item18"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option> 
								<option value="item33"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 33</option>
                                ';break;
                                case 18: echo '
								<option value="item9"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
								<option value="item18" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option> 
								<option value="item33"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 33</option>
                                ';break;
								case 33: echo '
								<option value="item9"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
								<option value="item18"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option> 
								<option value="item33" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 33</option>
                                ';break;
							} ?>
							</select>
						<?=Html::endForm(); ?>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				
				<div class="agile_top_brands_grids">
				    <?php foreach($products as $product): ?>
					<div class="col-md-4 top_brand_left">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
									<img src="images/offer.png" alt=" " class="img-responsive">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<?=Html::a('<img src='.\common\models\Product::getProductImageUrl($product['id'], $product['title']).'></img>', ['catalog/view', 'id' => $product['id']]) ?>
												<p><?=$product['title'] ?></p>
												<h4><?php if(\Yii::$app->user->isGuest): ?>$<?=$product['price'] ?><?php else: ?>$<?=$product['price']*0.75 ?> <span>$<?=$product['price'] ?></span><?php endif; ?></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<fieldset>
													<?=Html::a('Add to cart', ['cart/add', 'id' => $product['id']], ['class' => 'button']) ?>
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
				<nav class="numbering">
					<ul class="pagination paging">
						<?=LinkPager::widget(['pagination' => $pagination]) ?>
					</ul>
				</nav>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!--- groceries --->
