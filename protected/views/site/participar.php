<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Participar - ' .Yii::app()->name;

?>

<div class="form col-sm-6 ctn_iniciar-sesion">
  <div class="pagina_title">
    <h1>Iniciar sesión</h1>
    <p>Si ya estás registrado, inicia sesión en esta opción</p>
  </div>

  <?php $form=$this->beginWidget('CActiveForm', array(
  	'id'=>'login-form',
  	'enableAjaxValidation'=>true,
  	'enableClientValidation'=>true,
  	'clientOptions'=>array(
  		'validateOnSubmit'=>true,
  	),
  )); ?>

	<?php echo $form->errorSummary($model, '', '', array('class' => 'flash-notice') ); ?>
  <div class="ctn_formulario">
  	<div class="form-group">
  		<?php echo $form->label($model,'correo'); ?>
  		<?php echo $form->emailField($model,'correo', array('class' => 'form-control')); ?>
  	</div>

  	<div class="form-group">
  		<?php echo $form->label($model,'password'); ?>
  		<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
  	</div>

  	<div class="form-group rememberMe">

      <div class="checkbox-inline">
        <label>
          <?php echo $form->checkBox($model,'rememberMe'); ?>
          <?php echo $form->label($model,'rememberMe'); ?>
        </label>
      </div>
  	</div>

  	<div class="form-group buttons">
  		<?php echo CHtml::submitButton('Iniciar sesión', array('class' =>'btn btn-default btn-general_lg')); ?>
  	</div>

  	<div class="form-group ctn_recuperar">
  		<?php echo CHtml::link('¿Olvidaste la contraseña?', array('/recuperar-contrasena'), array('class' => 'recuperar' )); ?>
  	</div>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="col-sm-6">
  <div class="ctn_registro">
    <div class="pagina_title">
      <h1>Registrarse</h1>
      <p>Si es la primera vez que vas a participar, debes registrarte </p>
    </div>

  	<?php echo CHtml::link('Registrarme', array('registro'), array('class' => 'btn btn-primary btn-lg btn-general_lg') )?>
  </div>
</div>
