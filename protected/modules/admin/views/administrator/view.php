<div class="view">
	<header>
		<div class="row enc-header-pregunta">
			<div class="col-sm-10">
					<h1>Pregunta <?php echo $pregunta->id; ?> </h1>
			</div>
			<div class="col-sm-2">
				<?php echo CHtml::link( CHtml::image(Yii::app()->request->baseUrl . '/images/pencil.png', 'Editar Pregunta'), CHtml::normalizeUrl(Yii::app()->request->baseUrl.'/admin/administrator/editPregunta/id/'.$pregunta->id ) ); ?>
				<h4> Editar </h4>
			</div>

		</div>

				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$pregunta,
					'attributes'=>array(
						'nivel.nombre',
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
