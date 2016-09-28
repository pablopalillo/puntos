<?php $this->pageTitle = 'Modificar pregunta ' . $model->pregunta; ?>
<h1>Modificar Pregunta <?php echo $model->pregunta; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>