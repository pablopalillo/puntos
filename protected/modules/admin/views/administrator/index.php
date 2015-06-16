<?php

$this->pageTitle = Yii::app()->name;
//echo 'sizas'.Yii::app()->user->getState('es_admin');
?>

<div class="header-admin">
	<div class="row-fluid">
		<div class="col-sm-9 admin-info">
			<h2> Hola, admin </h2>
			<p>
				Puedes programar tus preguntas desde este lugar y crear una en cualquier momento.
			</p>
			<p>
				Las preguntas estan ordenadas por fecha de creación, que aparecerán
				desde la mas actuales hasta las mas antiguas.
				Recuerda que los niveles corresponden a la cantidad de puntos que se
				pueden lograr en caso de responder esta pregunta correctamente.
			<p>

			<ul>
				<li><strong>Nivel 1</strong> 10 puntos </strong></li>
				<li><strong>Nivel 2</strong> 20 puntos </strong></li>
				<li><strong>Nivel 3</strong> 30 puntos </strong></li>
			</ul>
		</div>
		<div class="col-sm-3">
			<?php echo CHtml::link('Nueva',Yii::app()->request->baseUrl . '/admin/administrator/create', array('class'=>'btn-general_md')); ?>
		</div>
	</div>
</div><!-- /header-admin -->
<div id="admin">

	<div >

		<?php

		 $this->widget('zii.widgets.grid.CGridView',
					array('dataProvider'=> $model->search(),
						'id' => 'custom-grid',
						'columns'=>array(
							'nivel.puntos',
							'pregunta',
							 array(           
           						 'name'=>'fecha',
           						 'value'=>'date_format(date_create($data->fecha), "d/m/Y")',
       						 ),
							'hora_inicio',
							'hora_fin',
							array(
									'class'=>'CButtonColumn',
									'template' => '{view}{delete}',
									'deleteConfirmation' =>
'¿Esta seguro de que desea eliminar esta pregunta?.
Al eliminar esta pregunta se borraran automaticamente las respuestas asociadas a esta , tambien se eliminaran las rondas de todos los usuarios asociados por lo tanto se pierden los punto obtenidos en este momento.',

								),
						),

					)

		);


		?>

	</div>

</div>
