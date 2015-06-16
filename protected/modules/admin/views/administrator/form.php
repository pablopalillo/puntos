<?php
/**
* @author telemedellin
* Administration form / add Pregunta
*
**/
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<div class="col-sm-6" >
  <div class="form">
    <div id="titulo-pregunta" class="titulo">
      <h1>Nueva pregunta</h1>
    </div>


    <?php
    $activeform = $this->beginWidget('CActiveForm', array(
      'id'=>'pregunta-form',
      'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
    ));
    ?>
    <?php
      $flashMessages = Yii::app()->user->getFlashes();
      if( $flashMessages )
      {
        echo '<div class="flash-notice"><ul>';

            foreach($flashMessages as $key => $value ):
            ?>
              <li class="<?php echo $key ?>"> <?php echo $value  ?> </li>
            <?php
           endforeach;
        echo '</ul></div>';
      }

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
        <?php echo $activeform->dropDownList($pregunta,'nivel_id', CHtml::listData(Nivel::model()->findAll(), 'id', 'puntos'), array('class'=>'form-control')); ?>
        <?php echo $activeform->error($pregunta,'nivel_id'); ?>
      </div>

      <div class="form-group">

  
        <?php echo $activeform->label($pregunta,'fecha' ); ?>
        <?php echo $activeform->textField($pregunta,'fecha',array('class' => 'form-control datepicker')); ?>
        <?php echo $activeform->error($pregunta,'fecha'); ?>
      </div>

      <div class="form-group">
        <?php echo $activeform->label($pregunta,'hora_inicio' ); ?>
        <?php echo CHtml::label('( 24hora:minuto )','formatoh'); ?>
        <?php echo $activeform->textField($pregunta,'hora_inicio',array('class' => 'form-control ')); ?>
        <?php echo $activeform->error($pregunta,'hora_inicio'); ?>
      </div>

      <div class="form-group">
        <?php echo $activeform->label($pregunta,'hora_fin' ); ?>
        <?php echo CHtml::label('( 24hora/minuto )','formatoh2'); ?>
        <?php echo $activeform->textField($pregunta,'hora_fin',array('class' => 'form-control')); ?>
        <?php echo $activeform->error($pregunta,'hora_fin'); ?>
      </div>
    </div>

  <div class="form-detail">
    <?php for( $i=0 ; $i <= 3 ; $i++ ): ?>
      <div class="well">
        <div class="form-group">
          <?php echo CHtml::label('Respuesta '.($i+1),'respuesta'); ?>
          <?php echo CHtml::textField('respuesta[]', ($respuestas[$i]['respuesta'])?$respuestas[$i]['respuesta']:'' , array('class' => 'form-control','maxlength'=>255)); ?>
        </div>

        <div class="radio">
          <label>
            <?php echo CHtml::radioButton('es_correcta', ($respuestas[$i]['es_correcta'])? true:false ,array('value' => "$i" )); ?>
            <?php echo CHtml::label('correcta','correcta'); ?>
          </label>
        </div>
      </div>
    <?php endfor; ?>

      <div class="form-group">
        <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-success')); ?>
      </div>
  </div>

  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
</div>
