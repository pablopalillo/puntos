<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Recuperar contraseña - ' .Yii::app()->name;
?>
<div id="recuperar">

	<header>
		<div id="titulo-recuperar">
			<h1>Recuperar contraseña</h1>
		</div>
	</header>

		<div class="form col-sm-5">

			<?php
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'recuperar-form',
			));
			?>

				<div class="control-group">
					<?php echo $form->label($model,'correo'); ?>
					<?php echo $form->emailField($model,'correo', array('class' => 'form-control') ); ?>
				</div>

				<div class="control-group">
					<?php echo CHtml::submitButton('Recuperar', array('class' => 'btn btn-default')); ?>
				</div>

			<?php $this->endWidget(); ?>

		</div><!-- form -->

</div>
