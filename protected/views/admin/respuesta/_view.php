<?php
/* @var $this RespuestaController */
/* @var $data Respuesta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pregunta_id')); ?>:</b>
	<?php echo CHtml::encode($data->pregunta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('respuesta')); ?>:</b>
	<?php echo CHtml::encode($data->respuesta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('es_correcta')); ?>:</b>
	<?php echo CHtml::encode($data->es_correcta); ?>
	<br />


</div>