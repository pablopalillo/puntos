<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/libs/ckeditor/ckeditor.js', CClientScript::POS_HEAD); ?>
<div class="view">
	<header>
		<div class="row enc-header-pregunta">
			<div class="col-sm-9 titulo">
					<h1><?php echo $model->nombre; ?> </h1>
			</div>
		</div>
	</header>

	<div id="contenido" class="form">
	    <?php
		    $activeform = $this->beginWidget('CActiveForm', array(
		      'id'=>'contenido-form',
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
		    <?php echo  $activeform->errorSummary( array($model), '', '', array('class' => 'flash-notice')); ?>
			  <div class="form-enc">
			      <div class="form-group">
			        <?php echo $activeform->textArea($model,'texto',array('class' => 'form-control','rows'=>10,'cols'=>80)); ?>
			        <?php echo $activeform->error($model,'texto'); ?>
			      </div>

			      <div class="form-group">
			        <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-success')); ?>
			      </div>
			  </div>

	  <?php $this->endWidget(); ?>
  </div> <!-- end form -->
	</div>





</div>
