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
					<p>Acabas de inscribirte para participar en el juego que te puede llevar hasta Suiza gracias a los Juegos Olímpicos de la Juventud Medellín 2018, ahora sólo debes dar click en el siguiente enlace y empezar a divertirte: </p>
					<p><?php echo CHtml::link('http://www.concursomedellin2018.com/verificar/' . $datos['llave_activacion'], CHtml::normalizeUrl('http://www.concursomedellin2018.com/verificar/' . $datos['llave_activacion'] ) ); ?></p>
					<p>Recuerda que el adulto que inscribiste como responsable también será informado de tu participación en el juego.</p>
				</table>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<img src="http://concursomedellin2018.com/images/mail/footer-mail.jpg" width="605" height="113" />
			</td>
		</tr>
	</table>
	</center>
</body>
</html>