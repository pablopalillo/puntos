<div class="btn-group pull-right">
  <?php echo CHtml::link('Agregar respuesta', $this->createUrl('respuesta/crear/', array('id' => $model->id)), array('class' => 'btn btn-default btn-sm'))?>
</div>
<?php if($respuestas->getData()): ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'  => $respuestas,
    'enableSorting' => true,
    'pager'         => array('pageSize' => 25),
    'htmlOptions'   => array('style' => 'clear:both;'), 
    'columns'       => array(
        'respuesta',
        'es_correcto', 
        array(
            'class'=>'CButtonColumn',
            'template'  => '{update}{delete}',
            'buttons'   => array(
                'update' => array(
                    'url'       => 'Yii::app()->createUrl("/administrador/respuesta/update", array("id"=>$data->id))', 
                ),
                'delete' => array(
                    'url'       => 'Yii::app()->createUrl("/administrador/respuesta/delete", array("id"=>$data->id))',
                ),/**/
            ),
        ),
    )
)); ?>
<?php endif; ?>