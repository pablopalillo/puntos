<?php
/* @var $this RespuestaController */
/* @var $model Respuesta */

$this->breadcrumbs=array(
	'Respuestas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Respuesta', 'url'=>array('index')),
	array('label'=>'Create Respuesta', 'url'=>array('create')),
	array('label'=>'View Respuesta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Respuesta', 'url'=>array('admin')),
);
?>

<h1>Update Respuesta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>