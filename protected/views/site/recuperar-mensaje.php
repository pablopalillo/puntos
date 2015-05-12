<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Recuperar contraseña - ' .Yii::app()->name;
?>

<div>
	<h1>Recuperar contraseña</h1>
	<p><?php echo $mensaje; ?></p>
</div><!-- form -->
<div id="right-content">
	<?php echo CHtml::link('<span class="resaltado">Regístrate</span> y empieza a jugar', array('registro'), array('class' => 'registrate') )?>
</div>