<?php
$class = "";

if ( $data->es_correcta )
{
	$class = "correcta";
}
?>

<div class="<?php echo $class ?> respuesta-group">
		<div class="well">
				<div class="row">
					<div class="col-sm-10">

							<div class="form-group">
								<?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:
								<?php echo CHtml::encode($data->id); ?>
							</div>
							<div class="form-group">
									<?php echo CHtml::encode($data->respuesta); ?>
							</div>
						</div>


					<div class="col-sm-2">
						<a href="<?php echo CHtml::normalizeUrl(Yii::app()->request->baseUrl.'/admin/administrator/editRespuesta/id/'.$data->id) ?>" >
							<button type="button" class="btn btn-success" aria-label="Left Align">
			  					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						 </a>
					</div>
				</div>
			</div>
</div>
