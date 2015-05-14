<?php
/* @var $this JugadorController */
?>

<div id="estadisticas" class="col-sm-4">

	<?php //echo CHtml::link( '¡Estamos verificando <span>los resultados!</span>', array('/puntajes'), array('class' => 'juega' ) ); ?>
	<header></header>
	<section id="estadisticas-content">
		<h3>Estadísticas</h3>

		<p> Puntaje del mes actual <span> 16 </span> </p>
		<p> Puntaje acomulado del año <span> 1500 </span> </p>
		<p> Posicion actual <span> 15 </span> </p>

		<p> Puntajetotal <span><?php echo $jugador->puntaje ?> </span></p>
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
			<h2>Datos de acceso</h2>
			<p>Correo: <?php echo $jugador->usuario->correo ?> </p>
			<p>Nombre: <?php echo $jugador->nombre_adulto ?></p>
		</header>

		<h2>Datos personales</h2>

		<p>Nombre: <?php echo $jugador->nombre ?> </p>
		<p>Edad : <?php echo $jugador->getEdad() ?> </p>
		<p>Tarjeta de identidad número: <?php echo $jugador->documento ?></p>
		<p>Telefono fijo: <?php echo $jugador->telefono ?> </p>

		<?php if( ! empty($jugador->correo_adulto) ): ?>
			<h2>Información del adulto responsable</h2>

			<p>Correo: <?php echo $jugador->correo_adulto ?></p>
			<p>Documento: <?php echo $jugador->documento_adulto ?></p>

	<?php endif; ?>

	</section>

</div>
