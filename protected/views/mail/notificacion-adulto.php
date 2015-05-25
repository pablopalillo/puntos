<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="language" content="es" />
</head>
<body bgcolor="#eee" style="background-color: #eee;">
	<center>
	<table bgcolor="#fff" style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="605">
		<tr>
			<td>
				<img src="http://concursomedellin2018.com/images/mail/header-mail.jpg" width="605" height="154" />
			</td>
		</tr>
		<tr>
			<td>
				<center>
				<table style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="500">
					<h3>Hola,  <?php echo strtok($datos['nombre_adulto'], ' '); ?> , </h3>
					<p><?php echo $datos['nombre']; ?> se inscribió en Puntos TM, La estrategia de fidelización de Telemedellín que premia la sintonía de nuestros televidentes</p>
					<p>Para participar en este juego fue necesario que él nos indicara el nombre de un adulto responsable que avalara su participación en dicho concurso, y por eso te llega este mensaje. </p>
					<p>Si tienes alguna inquietud o estás en desacuerdo, puedes escribirnos a <a mailto="puntostm@telemedellin.tv"></a>puntostm@telemedellin.tv</p>
					<p>Para mayor información visita <?php echo CHtml::link( CHtml::normalizeUrl(Yii::app()->request->baseUrl), CHtml::normalizeUrl( Yii::app()->request->baseUrl) ); ?></p>
				</table>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<p style="font-size: 11px; color: gray"><a style="color: gray; text-decorarion: underline" href="#">PuntosTm</a> es un producto de <a style="color: gray; text-decorarion: underline" href="#">Telemedellín</a></p>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>
