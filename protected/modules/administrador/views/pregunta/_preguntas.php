<div class="btn-group pull-right">
  <?php echo CHtml::link('Agregar pregunta', $this->createUrl('/administrador/pregunta/crear/', array('id' => $model->id)), array('class' => 'btn btn-default btn-sm'))?>
</div>
<?php if($preguntas->getData()): ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'  => $preguntas,
    'enableSorting' => true,
    'pager'         => array('pageSize' => 25),
    'htmlOptions'   => array('style' => 'clear:both;'), 
    'columns'       => array(
        'pregunta',
        array(
            'header' => 'Respuestas', 
            'value'  => 'count($data->respuestas)', 
        ),
        array(
            'class'=>'CButtonColumn',
            'template'  => '{view}{update}{delete}',
            'buttons'   => array(
                'view' => array(
                    'url'       => 'Yii::app()->createUrl("/administrador/pregunta/view", array("id"=>$data->id))', 
                ),
                'update' => array(
                    'url'       => 'Yii::app()->createUrl("/administrador/pregunta/update", array("id"=>$data->id))', 
                ),
                'delete' => array(
                    'url'       => 'Yii::app()->createUrl("/administrador/pregunta/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
)); ?>
<?php endif; ?>