<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Participar - ' .Yii::app()->name;

?>

<div class="form col-sm-6">
  <div class="well">
    <h1>Iniciar sesión</h1>
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
		<?php echo CHtml::submitButton('Iniciar sesión', array('class' =>'btn btn-default ')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::link('¿Olvidaste la contraseña?', array('/recuperar-contrasena'), array('class' => 'recuperar' )); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="col-sm-6">
  <div class="well">
    <span>Si es la primera vez que vas a participar, debes registrarte </span>
  </div>

	<?php echo CHtml::link('Registrarme', array('registro'), array('class' => 'btn btn-primary btn-lg btn-block') )?>
</div>
