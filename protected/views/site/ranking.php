<?php
/* @var $this SiteController */
$this->pageTitle = 'Ranking - '.Yii::app()->name;
?>
<div id="content-ranking">
	<h1>Puntajes</h1>
	<?php if( Yii::app()->user->hasFlash('error') ):?>
		<div class="flash-notice"><?php echo Yii::app()->user->getFlash('error'); ?></div>
	<?php endif;?>
	<div id="ninos">
		<div id="star-left"></div>
		<h2>Niños</h2>
		<p>Puesto</p>
		<p>Nombre</p>
		<p class="puntaje">Puntaje</p>
		<ul>
		<?php $i = 1; foreach($ranking['ninos'] as $nino): ?>
			<li><span class="lugar"><?php echo $i; $i++?></span> <?php echo $nino->nombre ?> <span class="total"><?php echo $nino->puntaje ?></span></li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div id="ninas">
		<div id="star-right"></div>
		<h2>Niñas</h2>
		<p>Puesto</p>
		<p>Nombre</p>
		<p class="puntaje">Puntaje</p>
		<ul>
		<?php $i = 1; foreach($ranking['ninas'] as $nina): ?>
			<li><span class="lugar"><?php echo $i; $i++?></span> <?php echo $nina->nombre ?> <span class="total"><?php echo $nina->puntaje ?></span></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
<!--<div id="btn-jugar">
	<?php //echo CHtml::link( '¿Quieres aparecer en estos puntajes? ¡Participa!', array('/jugar'), array('class' => 'btn-jugar' ) ); ?>
</div>-->