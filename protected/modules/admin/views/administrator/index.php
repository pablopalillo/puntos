<?php

$this->pageTitle = Yii::app()->name;
//echo 'sizas'.Yii::app()->user->getState('es_admin');
?>

<div class="header-admin">
	<div class="row-fluid">
		<div class="col-sm-9 admin-info">
			<h2> Hola, admin </h2>
			<p>
				Woo, Te contamos que tenemos novedades y actualizaciones.
			</p>
			<p>
				<ul>
					<li>Ahora puedes programar tus preguntas mucho mas fácil.</li>
					<li>Mejoras de seguridad al momento de responder preguntas.</li>
					<li>Ahora los usuarios deberán esperar a que termine la pregunta programada para saber su resultado.</li>
					<li>Los usuarios pueden ver sus ultimas 5 participaciones desde su perfil.</li>
					<li>Ahora puedes editar contenidos de la pagina.</li>
					<li>Puedes ver el listado de usuarios registrados.</li>
				</ul>
			<p>

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
