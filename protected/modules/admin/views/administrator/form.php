<?php
/**
* @author telemedellin
* Administration form / add Pregunta
*
**/

?>
<div class="col-sm-6" >
  <div class="form">
    <div id="titulo-pregunta" class="well well-lg">
      <h2>Nueva pregunta</h2>
    </div>


    <?php
    $activeform = $this->beginWidget('CActiveForm', array(
      'id'=>'pregunta-form',
      'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
    ));
    ?>

    <?php echo  $activeform->errorSummary( array($pregunta,$respuesta), '', '', array('class' => 'flash-notice')); ?>

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
      <?php echo CHtml::label('( año-mes-dia )','formato'); ?>
      <?php echo $activeform->textField($pregunta,'fecha',array('class' => 'form-control')); ?>
      <?php echo $activeform->error($pregunta,'fecha'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'hora_inicio' ); ?>
      <?php echo CHtml::label('( 24hora:minuto )','formatoh'); ?>
      <?php echo $activeform->timeField($pregunta,'hora_inicio',array('class' => 'form-control')); ?>
      <?php echo $activeform->error($pregunta,'hora_inicio'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($pregunta,'hora_fin' ); ?>
      <?php echo CHtml::label('( 24hora/minuto )','formatoh2'); ?>
      <?php echo $activeform->timeField($pregunta,'hora_fin',array('class' => 'form-control')); ?>
      <?php echo $activeform->error($pregunta,'hora_fin'); ?>
    </div>


  <?php for( $i=0 ; $i <= 3 ; $i++ ): ?>
    <div class="well">
      <div class="form-group">
        <?php echo CHtml::label('respuesta '.($i+1),'respuesta'); ?>
        <?php echo CHtml::textField('respuesta[]','', array('class' => 'form-control','maxlength'=>255)); ?>
      </div>

      <div class="radio">
        <label>
          <?php echo CHtml::radioButton('es_correcta',false,array('value' => "$i" )); ?>
          <?php echo CHtml::label('correcta','correcta'); ?>
        </label>
      </div>
    </div>
  <?php endfor; ?>

    <div class="form-group">
      <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-success')); ?>
    </div>

  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
</div>
