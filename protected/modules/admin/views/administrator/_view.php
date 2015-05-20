<?php
$class = "";

if ( $data->es_correcta )
{
	$class = "correcta";
}
?>

<div class="<?php echo $class ?> respuesta-group">

		<div class="form-group">
			<?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</div>

		<div class="form-group">
		<?php echo CHtml::encode($data->getAttributeLabel('respuesta')); ?>:
		<?php echo CHtml::encode($data->respuesta); ?>
		</div>

		<div class="correcta form-group">
		<?php echo CHtml::encode($data->getAttributeLabel('es_correcta')); ?>:
		<?php echo CHtml::encode($data->es_correcta); ?>
		</div>
</div>
