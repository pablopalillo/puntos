<?php
/* Pagina sencilla de contenido */

$this->pageTitle= Yii::app()->name;
?>
<div id="contenido" >
	<h1><?php echo $contenido->nombre ?> </h1>

	<div class="col-sm-12 contenido-texto" >
		<?php echo $contenido->texto ?>
	</div>
</div>
