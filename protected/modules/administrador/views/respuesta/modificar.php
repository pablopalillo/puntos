<?php $this->pageTitle = 'Modificar respuesta ' . $model->respuesta; ?>
<h1>Modificar Respuesta <?php echo $model->respuesta; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>