<?php
/* @var $this RespuestaController */
/* @var $model Respuesta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'respuesta-form',
	'enableAjaxValidation'=>false,
	'focus' => array($model, 'respuesta'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pregunta_id'); ?>
		<?php echo $form->dropDownList($model,'pregunta_id', CHtml::listData(Pregunta::model()->findAll(), 'id', 'pregunta'), array('options' => array( $_GET['id'] =>array('selected'=>true))) ); ?>
		<?php echo $form->error($model,'pregunta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'respuesta'); ?>
		<?php echo $form->textField($model,'respuesta',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'respuesta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'es_correcta'); ?>
		<?php echo $form->dropDownList($model,'es_correcta', array( 0 => 'No', 1 => 'Si') ); ?>
		<?php echo $form->error($model,'es_correcta'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->