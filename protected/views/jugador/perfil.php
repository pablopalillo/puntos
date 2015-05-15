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
			<span> Posicion actual</span>
			<h3> 15 </h3>
		</div>

		<div class="col-sm-11">
			<span> Puntaje del mes actual  </span>
			<h3> 16 </h3>
		</div>
		<div class="col-sm-11">
			<span>Puntaje acomulado del año</span>
			<h3> 1500 </h3>
		</div>

		<div class="col-sm-11">
			<span> Puntaje total</span>
			<h3> <?php echo $jugador->puntaje ?> </h3>
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
			<?php echo CHtml::link( 'Editar Información', Yii::app()->request->baseUrl . '/editar-perfil', array('class'=>'btn btn-primary') ); ?>
		</div>
	</section>



</div>
