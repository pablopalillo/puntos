<?php if($mensaje == 'correcto'): ?>
	<h2>¡Listo!</h2>
	<p>Nos hemos dado cuenta que ya estás listo para empezar a jugar y poder ganar el premio de un viaje a Suiza para comprobar que Medellín puede ser la sede de los Juegos Olímpicos de la Juventud 2018</p>
	<p>Para empezar a jugar y acumular puntos da clic en el siguiente enlace <?php echo CHtml::link( 'Jugar', array('/jugar') ); ?></p>
<?php else: ?>
	Falló
<?php endif; ?>