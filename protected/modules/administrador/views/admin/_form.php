<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScript('datepicker', 
    '$(".datepicker").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, yearRange: "1900:2015", changeYear: true}, $.datepicker.regional[ "es" ]);', 
    CClientScript::POS_READY);
?>
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
        <?php echo $form->label($model,'nombre', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-2">
            <?php echo $form->textField($model, 'nombre', array('class' => 'form-control')); ?>
        </div>
        <?php echo $form->error($model,'nombre'); ?>
    </div>
	<div class="form-group">
		<?php echo $form->label($model,'fecha', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
            <?php echo $form->textField($model, 'fecha', array('class' => 'form-control datepicker')); ?>
		</div>
        <?php echo $form->error($model,'fecha'); ?>
	</div>
    <div class="form-group">
		<?php echo $form->label($model,'estado', array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->dropDownList($model, 'estado', array(1 => 'Activada', 0 => 'Desactivada' ), array('class' => 'form-control')); ?>	
		</div>        
	</div>
	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->