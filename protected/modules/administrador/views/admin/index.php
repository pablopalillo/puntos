<?php $this->pageTitle = 'Ronda' ?>
<h1>Ronda</h1>
<?php echo CHtml::link('Nueva', $this->createUrl('crear'), array('class' => 'btn btn-primary')) ?>
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . ' alert-success">' . $message . "</div>\n";
    }
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
    'filter' => $model, 
	'enableSorting' => true,
	'columns'=>array(
        'nombre',
        'fecha',
        array(
            'header' => 'Preguntas', 
            'value'  => 'count($data->preguntas)', 
        ),
        array(
            'name'=>'estado',
            'header'=>'Publicado',
            'filter'=>array('1'=>'Si','0'=>'No'),
            'value'=>'($data->estado=="1")?("Sí"):("No")'
        ),
        array(
            'class'=>'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'update' => array(),
                'delete' => array(),
            ),
        ),
    )
)); ?>
