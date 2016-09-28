<?php
/* @var $this JuugarController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/effects.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);
?>
<p id="estado">
	<span class="nivel">Nivel <span id="nivel"></span> </span> <span class="pregunta">Pregunta <span id="numero_pregunta"></span></span> <span id="puntos"></span> <span class="puntos">puntos</span>
</p>
<p class="puntaje-general">Puntaje general </br><span id="total_puntos"></span></p>
<div id="juego-content">
	<div id="mensaje">
		<div></div>
		<a href="#" class=""></a>
	</div>
	<div id="pregunta">
		<p class="tiempo">Tiempo <span id="tiempo"></span></p>
		<p id="p" class="pregunta"></p>
		<a href="#" id="ra"></a>
		<a href="#" id="rb"></a>
		<a href="#" id="rc"></a>
		<a href="#" id="rd"></a>
		<!--<div id="logo-juego"></div>-->
	</div>
	<div id="sidebar">
		<p class="ayudas">Ayudas</p>
		<a class="segundos" href="#">10 segundos más</a>
		<a class="erradas" href="#">Elimina 2 preguntas erradas</a>
		<a class="avanza" href="#">Siguiente pregunta</a>
		<p></p>
	</div>
</div>