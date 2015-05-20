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

    <?php echo $activeform->errorSummary(array($pregunta,$respuesta), '', '', array('class' => 'flash-notice')); ?>

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


<?php for( $i=0 ; $i <= 3 ; $i++ ): ?>
  <div class="grupo-respuestas">
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
      <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-default')); ?>
    </div>

  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
</div>
