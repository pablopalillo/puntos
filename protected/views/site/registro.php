<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScript('datepicker',
	'$(".datepicker").datepicker({dateFormat: "yy-mm-dd", yearRange: "1865:2011", minDate: new Date(1865, 1, 1), maxDate: new Date(2011, 0, 0), changeMonth: true, changeYear: true}, $.datepicker.regional[ "es" ]);',
	CClientScript::POS_READY);
?>

<div id="content">


		<div class="form">
			<div id="titulo-registro" class="pagina_title">
				<h1>Registro</h1>
				<p class="note">Recuerda que estos datos deben ser reales, porque serán los que se solicitarán al momento de reclamar alguno de los premios.</p>
			</div>

		<?php
		$activeform = $this->beginWidget('CActiveForm', array(
			'id'=>'registro-form',
			'enableAjaxValidation'=>true,
			'focus'=>array($usuario,'correo'),
		));
		?>

		<?php echo $activeform->errorSummary(array($usuario, $jugador), '', '', array('class' => 'flash-notice')); ?>
		<div class="ctn_formulario-registro">
			<div class="ctn_grupo-formulario">
				<div class="ctn_titulo-grupo">
					<h2>Datos de acceso</h2>
				</div>

				<div class="form-group">
					<?php echo $activeform->label($usuario,'correo'); ?>
					<?php echo $activeform->emailField($usuario,'correo',array('class' => 'form-control','size'=>60, 'maxlength'=>100,'placeholder' => 'Correo electronico')); ?>
					<p class="text-opa">Ingresa estos datos con cuidado, no los podras cambiar</p>
				</div>

				<div class="form-group">
					<?php echo $activeform->label($usuario,'password' ); ?>
					<?php echo $activeform->passwordField($usuario,'password',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?>
				</div>
			</div>
			<div class="ctn_grupo-formulario">
				<div class="ctn_titulo-grupo">
					<h2>Datos personales</h2>
					<p>Estos son los datos basicos que utilizaremos para contactarte.</p>
				</div>
				<div class="form-group">
						<?php echo $activeform->label($jugador,'nombre'); ?>
						<?php echo $activeform->textField($jugador,'nombre',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?>
						<p class="text-opa">Ingresa estos datos con cuidado, no los podras cambiar</p>
				</div>
				<div class="form-group">
					<?php echo $activeform->label($jugador,'documento' ); ?>
					<?php echo $activeform->textField($jugador,'documento',array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
					<p class="text-opa">Ingresa estos datos con cuidado, no los podras cambiar</p>
				</div>
				<div class="control-group">
					<?php echo $activeform->label($jugador,'Género'); ?>
					<div class="radio" >
						<label>
							<?php echo $activeform->radioButtonList($jugador,'sexo', array('M' => 'Masculino', 'F' => 'Femenino') ); ?>
						</label>
					</div>
				</div>

				<div class="form-group">
					<?php echo $activeform->label($jugador,'fecha_nacimiento'); ?>
					<?php echo $activeform->textField($jugador,'fecha_nacimiento', array('class' => 'form-control datepicker')); ?>
				</div>

				<div class="form-group">
					<?php echo $activeform->label($jugador,'telefono'); ?>
					<?php echo $activeform->textField($jugador,'telefono',array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
				</div>


				<div id="responsable" >
						<div class="ctn_titulo-grupo">
							<h2>Información del adulto responsable</h2>
							<p>Ingresa estos datos con mucho cuidado, porque serán utilizados si resultas ganador</p>
						</div>

						<div class="form-group">
							<?php echo $activeform->label($jugador,'nombre_adulto'); ?>
							<?php echo $activeform->textField($jugador,'nombre_adulto',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?>
						</div>

						<div class="form-group">
							<?php echo $activeform->label($jugador,'documento_adulto'); ?>
							<?php echo $activeform->textField($jugador,'documento_adulto',array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
						</div>
				<!--
						<div class="form-group">
							<?php echo $activeform->label($jugador,'parentesco_id'); ?>
							<?php echo $activeform->dropDownList($jugador,'parentesco_id', CHtml::listData(Parentesco::model()->findAll(), 'id', 'nombre'), array('class'=>'form-control')); ?>
						</div>
				-->
						<div class="form-group">
							<?php echo $activeform->label($jugador,'correo_adulto'); ?>
							<?php echo $activeform->emailField($jugador,'correo_adulto',array('class' => 'form-control','size'=>60,'maxlength'=>100, 'placeholder' => 'Correo responsable')); ?>
						</div>

				</div>
			</div>

				<div class="well well-lg form-group">
					<p>Al registrarte aceptas haber leído y estar de acuerdo con los <?php echo CHtml::link('términos y condiciones del ', array('/terminos-y-condiciones'), array('target' => '_blank'));?>.</p>
				</div>

				<div class="form-group">
					<?php echo CHtml::submitButton('Registro', array('class'=>'btn btn-default btn-general_lg')); ?>
				</div>
		</div><!-- /ctn_formulario-registro -->
		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
