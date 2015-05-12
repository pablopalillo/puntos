<?php
/* @var $this PreguntaController */
/* @var $model Pregunta */

$this->breadcrumbs=array(
	'Preguntas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pregunta', 'url'=>array('index')),
	array('label'=>'Manage Pregunta', 'url'=>array('admin')),
);
?>

<h1>Create Pregunta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>