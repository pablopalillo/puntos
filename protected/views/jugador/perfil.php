<?php
/* @var $this JugadorController */
?>
<div id="perfil">
<div id="titulo-registro">
<h1>Perfil</h1>
<p class="note">Aquí podrás cambiar algunos de los datos con los que te registraste</p>
</div>
<div id="left-content">
	<h2>Datos de acceso</h2>
	<p>Correo: <?php echo $jugador->usuario->correo ?></p>

	<h2>Datos personales</h2>
	<p><?php echo $jugador->nombre ?></p>
	<p>Tarjeta de identidad número: <?php echo $jugador->documento ?></p>
	<p>Edad: <?php echo $jugador->edad ?> años</p>
	<p>Niñ<?php echo ($jugador->sexo == 'M')? 'o': 'a'; ?></p>
	<p>Colegio: <?php echo $jugador->colegio ?></p>

	<h2>Información del adulto responsable</h2>
	<p>Nombre: <?php echo $jugador->nombre_adulto ?></p>
	<p>Parentesco: <?php echo $jugador->parentesco->nombre ?></p>
	<p>Correo: <?php echo $jugador->correo_adulto ?></p>
	<p>Documento: <?php echo $jugador->documento_adulto ?></p>
	<p>Teléfono fijo: <?php echo $jugador->telefono ?></p>
</div>
<div id="right-content">
	<?php echo CHtml::link( '¡Estamos verificando <span>los resultados!</span>', array('/puntajes'), array('class' => 'juega' ) ); ?>
	<div id="estadisticas">
		<h3>Estadísticas</h3>
		<p>Puntaje total <span><?php echo $jugador->puntaje ?></span></p>
		<p>Rondas jugadas <span><?php echo $estadisticas['rondas'] ?></span></p>
		<p>Tiempo total de juego <span><?php echo $estadisticas['tiempo'] ?></span></p>
		<p>Total de preguntas resueltas <span><?php echo $estadisticas['preguntas'] ?></span></p>

		<p>Fecha última ronda <span><?php echo $estadisticas['fecha_ultima'] ?></span></p>
		<p>Puntaje última ronda <span><?php echo $estadisticas['puntos_ultima'] ?></span></p>
		<p>Tiempo última ronda <span><?php echo $estadisticas['tiempo_ultima'] ?></span></p>
		<p>Preguntas última ronda <span><?php echo $estadisticas['preguntas_ultima'] ?></span></p>
	</div>
</div>
</div>