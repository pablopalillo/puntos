<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div id="content">
	<article class="row">
		<header>
				<h2>Error <?php echo $code; ?></h2>
			</header>
			<section class="col-sm-7 error">
				<?php echo CHtml::encode($message); ?>
			</section>
	</article>
</div>
