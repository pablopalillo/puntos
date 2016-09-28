<?php
/**
* @author telemedellin
* Administration form / edit Pregunta
*
**/
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<div class="col-sm-6" >
  <div class="form">
    <div id="titulo-pregunta" class="titulo">
      <h2>Editar pregunta <?php echo $pregunta->id ?></h2>
    </div>


    <?php
    $activeform = $this->beginWidget('CActiveForm', array(
      'id'=>'pregunta-form',
      'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
    ));
    ?>

    <?php echo  $activeform->errorSummary( array($pregunta), '', '', array('class' => 'flash-notice')); ?>
  <div class="form-enc">
    <div class="form-group">
      <?php echo $activeform->label($pregunta,'pregunta'); ?>
      <?php echo $activeform->textField($pregunta,'pregunta',array('class' => 'form-control','maxlength'=>255)); ?>
      <?php echo $activeform->error($pregunta,'pregunta'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'nivel_id' ); ?>
      <?php echo $activeform->dropDownList($pregunta,'nivel_id', CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'), array('class'=>'form-control')); ?>
      <?php echo $activeform->error($pregunta,'nivel_id'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'fecha' ); ?>
      <?php echo $activeform->textField($pregunta,'fecha',array('class' => 'form-control datepicker')); ?>
      <?php echo $activeform->error($pregunta,'fecha'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'hora_inicio' ); ?>
      <?php echo CHtml::label('( 24Hora:minuto )','hora1'); ?>
      <?php echo $activeform->textField($pregunta,'hora_inicio',array('class' => 'form-control')); ?>
      <?php echo $activeform->error($pregunta,'hora_inicio'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'hora_fin' ); ?>
      <?php echo CHtml::label('( 24Hora:minuto )','hora2'); ?>
      <?php echo $activeform->textField($pregunta,'hora_fin',array('class' => 'form-control')); ?>
      <?php echo $activeform->error($pregunta,'hora_fin'); ?>
    </div>
  </div>
    <div class="form-group">
      <?php echo CHtml::submitButton('Actualizar', array('class'=>'btn btn-success')); ?>
    </div>

  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
</div>
