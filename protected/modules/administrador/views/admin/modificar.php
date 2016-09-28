<?php $this->pageTitle = 'Modificar ronda ' . $model->nombre; ?>
<h1>Modificar Ronda <?php echo $model->nombre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>