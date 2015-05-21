<div class="view">
	<header>

			<h1>Pregunta <?php echo $pregunta->id; ?> </h1>

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
