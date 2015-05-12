<?php
/* @var $this PreguntaController */
/* @var $model Pregunta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pregunta-form',
	'enableAjaxValidation'=>false,
	'focus' => array($model, 'pregunta'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nivel_id'); ?>
		<?php echo $form->dropDownList($model,'nivel_id', CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'), array('options' => array( '5' =>array('selected'=>true))) ); ?>
		<?php echo $form->error($model,'nivel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pregunta'); ?>
		<?php echo $form->textField($model,'pregunta',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pregunta'); ?>
	</div>

	<div class="row buttons">
		<?php echo $form->hiddenField($model,'estado', array('value' => 1)); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->