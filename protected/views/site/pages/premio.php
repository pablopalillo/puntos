<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - ¿Qué incluye el premio?';
?>
<div id="content-premio" class="row">
	<h1>¿Qué te puedes ganar?</h1>

	<div class="hidden-xs visible-md-10" >
		<div>
			<?php echo CHtml::image(Yii::app()->getBaseUrl() . '/images/premio1.jpg', 'Puntos TM'); ?>
		</div>
		<div>
			<?php echo CHtml::image(Yii::app()->getBaseUrl() . '/images/premio2.jpg', 'Puntos TM'); ?>
		</div>
	</div>

	<div class="hidden-lg hidden-md visible-xs-10" >
		<div>
			<?php echo CHtml::image(Yii::app()->getBaseUrl() . '/images/premios-m.jpg', 'Puntos TM'); ?>
		</div>
	</div>
</div>
