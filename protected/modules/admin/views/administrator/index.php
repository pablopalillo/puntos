<?php
/* @var $this Administrator */

$this->pageTitle = Yii::app()->name;
?>
<div id="admin">

	<div >

		<?php

		 $this->widget('zii.widgets.grid.CGridView',
					array('dataProvider'=> $model->search(),
						'columns'=>array(
							'nivel.nombre',
							'pregunta',
							'estado',
							array(
									'class'=>'CButtonColumn',
								),
						),

					)

		);


		?>

	</div>

</div>
