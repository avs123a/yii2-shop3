<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Register Here</h2>
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
			<div class="login-form-grids">
				<h5>profile information</h5>

					<?= $form->field($model, 'first_name') ?>
					
					<?= $form->field($model, 'last_name') ?>
				
				<div class="register-check-box">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>Subscribe to Newsletter</label>
					</div>
				</div>
				<h6>Login information</h6>
					
					<?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>
					
					<div class="register-check-box">
						<div class="check">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>I accept the terms and conditions</label>
						</div>
					</div>
					<?= Html::submitButton('Register') ?>
				</form>
			</div>
			<?php ActiveForm::end(); ?>
			<div class="register-home">
				<?=Html::a('Home', ['site/index']) ?>
			</div>
		</div>
	</div>
<!-- //register -->
</div>
