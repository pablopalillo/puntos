<?php
$class = "";

if ( $data->es_correcta )
{
	$class = "correcta";
}
?>

<div class="<?php echo $class ?> respuesta-group">

		<div class="well">
			<div class="form-group">
				<?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:
				<?php echo CHtml::encode($data->id); ?>
			</div>
			<div class="form-group">
					<?php echo CHtml::encode($data->respuesta); ?>
			</div>

		</div>

</div>
