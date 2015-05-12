<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Recuperar contraseña - ' .Yii::app()->name;
?>

<div class="form login">
	<h1>Recuperar contraseña</h1>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'recuperar-form',
)); 
?>
	<div class="row">
		<?php echo $form->label($model,'correo'); ?>
		<?php echo $form->emailField($model,'correo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Recuperar', array('class' =>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<div id="right-content">
	<?php echo CHtml::link('<span class="resaltado">Regístrate</span> y empieza a jugar', array('registro'), array('class' => 'registrate') )?>
</div>