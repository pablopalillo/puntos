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
		<?php echo $form->label($model,'nivel_id', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
        	<?php echo $form->dropDownList($model, 'nivel_id', CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'), array('class' => 'form-control')); ?>
    	</div>
    </div>
	<div class="form-group">
		<?php echo $form->label($model,'pregunta', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
            <?php echo $form->textField($model, 'pregunta', array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		</div>
        <?php echo $form->error($model,'pregunta'); ?>
	</div>
	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->