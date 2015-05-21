<?php
/**
* @author telemedellin
* Administration form / add Pregunta
*
**/

?>
<div class="col-sm-6" >
  <div class="form">
    <div id="titulo-respuesta" class="well well-lg">
      <h2>Editar Respuesta <?php echo $respuesta->id ?></h2>
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
    <?php echo  $activeform->errorSummary( array($respuesta), '', '', array('class' => 'flash-notice')); ?>

    <div class="form-group">
      <?php echo $activeform->label($respuesta,'respuesta'); ?>
      <?php echo $activeform->textField($respuesta,'respuesta',array('class' => 'form-control','maxlength'=>255)); ?>
      <?php echo $activeform->error($respuesta,'respuesta'); ?>
    </div>

    <div class="form-group">
      <?php echo $activeform->label($respuesta,'es_correcta' ); ?>
      <?php echo $activeform->error($respuesta,'es_correcta'); ?>
    </div>
    <div class="radio">

      <label>
        <?php echo $activeform->radioButtonList($respuesta,'es_correcta',array('1'=>'si', '0'=>'no')); ?>
      </label>
    </div>

    <div class="form-group">
      <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-success')); ?>
    </div>

  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
</div>
