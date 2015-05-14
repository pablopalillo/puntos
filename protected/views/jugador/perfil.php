<?php
/* @var $this JugadorController */
?>

<div id="estadisticas" class="col-sm-4">
	<header>
		<?php echo CHtml::link( 'PARTICIPA', array('/jugar'), array('class' => 'btn btn-primary btn-lg btn-block' ) ); ?>
		<h1>Estadísticas</h1>
	</header>
	<section class="col-sm-12" id="estadisticas-content">

		<div class="col-sm-11">
			<h3> Posicion actual</h3>
			<span> 15 </span>
		</div>

		<div class="col-sm-11">
			<h3> Puntaje del mes actual  </h3>
			<span> 16 </span>
		</div>
		<div class="col-sm-11">
			<h3>Puntaje acomulado del año</h3>
			<span> 1500 </span>
		</div>

		<div class="col-sm-11">
			<h3> Puntaje total</h3>
			<span> <?php echo $jugador->puntaje ?> </span>
		</div>

	<!-- 	<p> Rondas jugadas <span> <?php //echo $estadisticas['rondas'] ?> </span></p> -->
	<!--	<p>Tiempo total de juego <span> <?php //echo $estadisticas['tiempo'] ?> </span></p> -->
<!--		<p>Total de preguntas resueltas <span> <?php //echo $estadisticas['preguntas'] ?> </span></p> -->

	<!--	<p>Fecha última ronda <span><?php //echo $estadisticas['fecha_ultima'] ?></span></p>
		<p>Puntaje última ronda <span><?php //echo $estadisticas['puntos_ultima'] ?></span></p>
		<p>Tiempo última ronda <span><?php //echo $estadisticas['tiempo_ultima'] ?></span></p>
		<p>Preguntas última ronda <span><?php //echo $estadisticas['preguntas_ultima'] ?></span></p> -->

	</section>

</div>


<div id="perfil" class="col-sm-8">

	<header>
		<h1>Perfil</h1>
	</header>

	<section id="perfil-content">
		<header>
			<strong>Datos de acceso</strong>
			<p>Correo: <?php echo $jugador->usuario->correo ?> </p>
			<p>Nombre: <?php echo $jugador->nombre_adulto ?></p>
		</header>

		<strong>Datos personales</strong>

		<p>Nombre: <?php echo $jugador->nombre ?> </p>
		<p>Edad : <?php echo $jugador->getEdad() ?> </p>
		<p>Documento Identidad: <?php echo $jugador->documento ?></p>
		<p>Telefono fijo: <?php echo $jugador->telefono ?> </p>

		<?php if( ! empty($jugador->correo_adulto) ): ?>
			<strong>Adulto responsable </strong>

			<p>Correo: <?php echo $jugador->correo_adulto ?></p>
			<p>Documento: <?php echo $jugador->documento_adulto ?></p>
		<?php endif; ?>

		<div >
			<?php echo CHtml::link( 'Editar Información', Yii::app()->request->baseUrl . '/participar', array('class'=>'btn btn-primary') ); ?>
		</div>
	</section>



</div>
