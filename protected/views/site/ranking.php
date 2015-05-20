<?php
/* @var $this SiteController */
$this->pageTitle = 'Ranking - '.Yii::app()->name;

Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/effects.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);

?>
<div id="content-ranking">
	<h1>Puntajes</h1>
	<?php if( Yii::app()->user->hasFlash('error') ):?>
		<div class="flash-notice"><?php echo Yii::app()->user->getFlash('error'); ?></div>
	<?php endif;?>
    <div class="col-md-6">
	    <div id="total-mes">
            <div class="col-md-8">
                <h2>Total por mes</h2>
            </div>
            <div class="col-md-4">
                <select id="meses" class="form-control">
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="clear"></div>
            <p></p>
		    <p>Puesto</p>
		    <p>Nombre</p>
		    <p class="puntaje">Puntaje</p>
		    <ul>
		    <?php $i = 1; foreach($total_mes as $mes): ?>
			    <li><span class="lugar"><?php echo $i; $i++?></span><?php echo $mes['jugador'] ?><span class="total"><?php echo $mes['puntaje'] ?></span></li>
		    <?php endforeach; ?>
		    </ul>
	    </div>
    </div>
    <div class="col-md-6">
        <div id="total-anho">
            <h2>Total por año</h2>
            <p>Puesto</p>
            <p>Nombre</p>
            <p class="puntaje">Puntaje</p>
            <ul>
            <?php $i = 1; foreach($total_anho as $anho): ?>
                <li><span class="lugar"><?php echo $i; $i++?></span> <?php echo $anho['jugador'] ?> <span class="total"><?php echo $anho['puntaje'] ?></span></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<!--<div id="btn-jugar">
	<?php //echo CHtml::link( '¿Quieres aparecer en estos puntajes? ¡Participa!', array('/jugar'), array('class' => 'btn-jugar' ) ); ?>
</div>-->