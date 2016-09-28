<?php $this->pageTitle = 'Pregunta ' . $model->pregunta; ?>
<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked">
		  <li><?php echo CHtml::link('<span class="glyphicon glyphicon-pencil"></span> Editar', $this->createUrl('pregunta/update/', array('id' => $model->id) ))?></li>
		</ul>
	</div>
	<div class="col-sm-10">
		<h1>Pregunta <?php echo $model->pregunta; ?></h1>
		<?php
		    foreach(Yii::app()->user->getFlashes() as $key => $message) {
		        echo '<div class="flash-' . $key . ' alert alert-info">' . $message . "</div>\n";
		    }
		?>
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data' => $model, 
			'attributes'=>array(
				'pregunta',
				array(
					'name' => 'estado',
					'label' => 'Estado', 
					'value' => ($model->estado==1)?'Publicado':'Desactivado',
				),
			),
		)); ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
	<?php 
	$tabs_content['respuestas'] = 
		array(
            'title'=>'Respuestas',
            'view'=>'/respuesta/_respuestas', 
            'data'=> array('respuestas' => $respuestas, 'model' => $model)
        );
	if( isset($tabs_content) ) $this->widget('CTabView', array('tabs' => $tabs_content));
	?>
	</div>
</div>