<div id="recuperar" >
	<header id="titulo-registro" class="well well-lg">
		<h1>Recuperar contraseña</h1>
		<p>Escribe tu nueva contraseña</p>
	</header>

	<div class="form">
		<?php
		$activeform = $this->beginWidget('CActiveForm', array(
			'id'=>'recuperar-form',
		));
		?>
		<?php echo $activeform->errorSummary($model); ?>

		<div class="form-group">
			<?php echo $activeform->label($model,'password', array('label' => 'Contraseña') ); ?>
			<?php echo $activeform->passwordField($model,'password',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?>
		</div>

		<div class="form-group">
			<?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-default')); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
