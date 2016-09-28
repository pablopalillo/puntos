
<div id="update">

		<div class="form">
			<div id="titulo-registro">
				<h1 class="titulos">Editar Informacion</h1>
				<p class="note">Recuerda que estos datos deben ser reales, porque serán los que se solicitarán al momento de reclamar alguno de los premios.</p>
			</div>

		<?php
		$activeform = $this->beginWidget('CActiveForm', array(
			'id'=>'registro-form',
			'enableAjaxValidation'=>true
		));
		?>

		<?php echo $activeform->errorSummary(array($model), '', '', array('class' => 'flash-notice')); ?>

		<div>
			<h2 class="subtitulos">Datos personales</h2>
			<p>Estos son los datos basicos que utilizaremos para contactarte.</p>
		</div>


    <div class="form-group">
      <?php echo $activeform->label($model,'telefono'); ?>
      <?php echo $activeform->textField($model,'telefono',array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>


		<div class="form-group">
				<?php echo CHtml::submitButton('Guardar', array('class'=>'btn-general_md')); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
