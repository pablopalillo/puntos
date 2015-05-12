<?php
/* @var $this RespuestaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Respuestas',
);

$this->menu=array(
	array('label'=>'Create Respuesta', 'url'=>array('create')),
	array('label'=>'Manage Respuesta', 'url'=>array('admin')),
);
?>

<h1>Respuestas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
