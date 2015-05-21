<?php
/* @var $this Administrator */

$this->pageTitle = Yii::app()->name;
?>
<div class="header-admin">
	<div class="row-fluid">
		<div class="col-sm-9 admin-info">
			<h2> Hola, admin </h2>
			<p>
				Puedes programar tus preguntas desde este lugar y crear una en cualquier momento.
			</p>
			<p>
				Las preguntas estan ordenadas por fecha de creacion, que apareceran
				desde la mas actuales hasta las mas antiguas.</p>
		</div>
		<div class="col-sm-3">
			<?php echo CHtml::link('Nueva','administrator/create', array('class'=>'btn-general_md')); ?>
		</div>
	</div>
</div><!-- /header-admin -->
<div id="admin">

	<div >

		<?php

		 $this->widget('zii.widgets.grid.CGridView',
					array('dataProvider'=> $model->search(),
						'columns'=>array(
							'nivel.nombre',
							'pregunta',
							'fecha',
							'hora_inicio',
							'hora_fin',
							array(
									'class'=>'CButtonColumn',
									'template' => '{view}{delete}',
								),
						),

					)

		);


		?>

	</div>

</div>
