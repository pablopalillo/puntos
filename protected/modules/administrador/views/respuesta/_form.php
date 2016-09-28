<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'url-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data', 
        'role' => 'form',
        'class' => 'form-horizontal' 
    )
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->label($model,'respuesta', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
            <?php echo $form->textField($model, 'respuesta', array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		</div>
        <?php echo $form->error($model,'respuesta'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->label($model,'es_correcto', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
        	<?php echo $form->dropDownList($model, 'es_correcto', array(0 => 'Incorrecta', 1 => 'Correcta'), array('class' => 'form-control')); ?>
    	</div>
    </div>
	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->