<div class="view">
	<header>
		<div class="row enc-header-pregunta">
			<div class="col-sm-9">
					<h1>Pregunta <?php echo $pregunta->id; ?> </h1>
			</div>
			<div class="col-sm-3">
				<?php echo CHtml::link('Editar Pregunta',CHtml::normalizeUrl(Yii::app()->request->baseUrl.'/admin/administrator/editPregunta/id/'.$pregunta->id ), array('class'=>'btn-general_md')); ?>
			</div>

		</div>

				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$pregunta,
					'attributes'=>array(
						array(
						 'label'=>'Nivel',
						 'value' => $pregunta->nivel->nombre,
						),
						'pregunta',
						'fecha',
						'hora_inicio',
						'hora_fin',
					),

				));
		?>
	</header>

	<div id="details" class="form">

		<?php	$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
			));
		 ?>
	</div>




</div>
