<?php $this->pageTitle = 'Ronda de ' . $model->nombre; ?>
<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked">
		  <li><?php echo CHtml::link('<span class="glyphicon glyphicon-pencil"></span> Editar', $this->createUrl('admin/update/', array('id' => $model->id) ))?></li>
		</ul>
	</div>
	<div class="col-sm-10">
		<h1>Ronda del <?php echo $model->nombre; ?></h1>
		<?php
		    foreach(Yii::app()->user->getFlashes() as $key => $message) {
		        echo '<div class="flash-' . $key . ' alert alert-info">' . $message . "</div>\n";
		    }
		?>
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data' => $model, 
			'attributes'=>array(
				'nombre',
				'fecha',
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
	$tabs_content['preguntas'] = 
		array(
            'title'=>'Preguntas',
            'view'=>'/pregunta/_preguntas', 
            'data'=> array('preguntas' => $preguntas, 'model' => $model)
        );
	if( isset($tabs_content) ) $this->widget('CTabView', array('tabs' => $tabs_content));
	?>
	</div>
</div>