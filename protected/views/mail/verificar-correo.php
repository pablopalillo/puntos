<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="language" content="es" />
</head>
<body bgcolor="#eee" style="background-color: #eee;">
	<center>
	<table  bgcolor="#fff" style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="605">
		<tr>
			<td>
				<img src="http://concursomedellin2018.com/images/mail/header-mail.jpg" width="605" height="154" />
			</td>
		</tr>
		<tr>
			<td>
				<center>
				<table style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="500">
					<h3>Hola <?php echo $datos['nombre']; ?>, </h3>
					<p>Acabas de inscribirte para participar en Puntos TM </p>
					<p>Ingresa al siguiente link para que comiences a acumular puntos y ganar con Telemedellín:</p>
					<p><?php echo CHtml::link( Yii::app()->request->baseUrl.'/verificar/'.$datos['llave_activacion'], Yii::app()->request->baseUrl.'/verificar/'.$datos['llave_activacion'] ); ?></p>
					<p><strong>(Observación solo para menores de edad)</strong></p>
					<p>Recuerda que el adulto que inscribiste como responsable, también será informado a través de correo electrónico de tu participación.</p>
				</table>
				</center>
			</td>
		</tr>
		<tr>
			<td align="center">
				<p style="font-size: 11px; color: gray"><a style="color: gray; text-decorarion: underline" href="#">PuntosTm</a> es un producto de <a style="color: gray; text-decorarion: underline" href="#">Telemedellín</a></p>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>
