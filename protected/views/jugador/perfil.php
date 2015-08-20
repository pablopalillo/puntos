<?php
/* @var $this JugadorController */
?>
<div class="ctn_perfil">
	<div id="estadisticas" class="col-sm-6 ctn_estadisticas">
		<header>
			<?php echo CHtml::link( 'Participa', array('/participar'), array('class' => 'btnParticipar' ) ); ?>
		</header>
		<section class="col-sm-12" id="estadisticas-content">
			<div class="ctn_puntaje-mes ctn_puntajes">
				<span class="puntaje-label">Puntaje del mes actual</span>
                <span class="puntaje"> <?php echo $puntaje_mes; ?></span>
			</div>
			<div class="ctn_puntaje-ano ctn_puntajes">
				<span class="puntaje-label">Puntaje acumulado del año</span>
                <span class="puntaje"> <?php echo $puntaje_anho; ?></span>
			</div>
			<div class="ctn_puntaje-posicion ctn_puntajes">
				<span class="puntaje-label">Posición actual</span>
				<div class="row-fluid">
					<div class="col-xs-6">
                        <span class="puntaje"> <?php echo $ranking_mes; ?></span>
						<span class="puntaje-posicion_label">Mes actual</span>
					</div>
					<div class="col-xs-6">
                        <span class="puntaje"> <?php echo $ranking_anho; ?></span>
						<span class="puntaje-posicion_label">Año actual</span>
					</div>
				</div>
			</div>
		</section>

	</div><!-- /ctn_estadisticas -->

	<div id="perfil" class="col-sm-6 ctn_datos">
		<header>
			<h1 class="titulos">Perfil</h1>
		</header>
		<section id="perfil-content">
			<header>
				<h2 class="subtitulos">Datos de acceso</h2>
				<p>Correo: <?php echo $jugador->usuario->correo ?> </p>
				<p>Nombre: <?php echo $jugador->nombre ?> </p>
			</header>
			<h2 class="subtitulos">Datos personales</h2>

			<p>Edad : <?php echo $jugador->getEdad() ?> </p>
			<p>Documento Identidad: <?php echo $jugador->documento ?></p>
			<p>Telefono fijo: <?php echo $jugador->telefono ?> </p>

			<?php if( ! empty($jugador->correo_adulto) ): ?>
				<h2 class="subtitulos">Adulto responsable </h2>
				<p>Nombre: <?php echo $jugador->nombre_adulto ?> </p>
				<p>Correo: <?php echo $jugador->correo_adulto ?></p>
				<p>Documento: <?php echo $jugador->documento_adulto ?></p>
			<?php endif; ?>

			<section id="perfil-puntaje">
				<header>
					<h2 class="subtitulos">Ultimas Respuestas</h2>
				</header>

				<?php if( ! empty($rxj) ): ?>
				<table class="table-result" >
					<tr>
						<th>Pregunta</th>
						<th>Respuesta</th>
						<th>Puntos </th>
						<th>Fecha</th>

					</tr>
					<?php foreach ($rxj as $key => $res): ?>
						<tr>
							<td><?php echo $res->pregunta->pregunta ?></td>
							<td class="td-center"><?php
								if( $res->respuesta->es_correcta == 1)
								{
									 echo "Correcta" ;
								}
								else
								{
									echo 'Fallò' ;
								}
							 ?>
							</td>
							<td class="td-center"><?php echo  $res->pregunta->nivel->puntos ?></td>
							<td><?php echo  $res->fecha ?></td>
						</tr>


					<?php endforeach; ?>
				</table>	
				<?php endif; ?>



			</section>

			<!--<div >
				<?php echo CHtml::link( 'Editar Información', Yii::app()->request->baseUrl . '/editar-perfil', array('class'=>'btn-general_md') ); ?>
			</div>-->
			<div class="ctn_btn-cerrar-sesion">
	            <?php echo CHtml::link( 'Cerrar sesion', array('/cerrar-sesion'), array('class' => 'btn-general_md' ) ); ?>
	        </div>
		</section>
		


	</div><!-- /ctn_datos -->
</div><!-- /ctn_perfil -->
