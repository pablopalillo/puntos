<div id="content">
	<div id="titulo-registro">
		<h1>Recuperar contraseña</h1>
		<p class="note">Escribe tu nueva contraseña</p>
	</div>

	<div class="form">
	<?php 
	$activeform = $this->beginWidget('CActiveForm', array(
		'id'=>'recuperar-form',
	));
	?>
	<?php echo $activeform->errorSummary($model); ?>

	<div class="row">
		<?php echo $activeform->label($model,'password', array('label' => 'Contraseña') ); ?>
		<?php echo $activeform->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?> 
	</div>

	<div class="row buttons submit">
		<?php echo CHtml::submitButton('Guardar', array('class'=>'btn')); ?>
	</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
