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
					<h3>¿Qué tal <?php echo strtok($datos['nombre_adulto'], ' '); ?>?, </h3>
					<p><?php echo $datos['nombre']; ?> se acaba de inscribir en el juego que lo puede llevar hasta Suiza para presenciar la aceptación de Medellín como sede de los Juegos Olímpicos de la Juventud 2018.</p>
					<p>Para poder participar en este juego fue necesario que él nos indicara el nombre de un adulto responsable que avala la participación en dicho concurso.</p>
					<p>Te agradecemos su autorización para participar y esperamos que él sea uno de los ganadores.</p>
					<p>Para mayor información visita <?php echo CHtml::link('http://www.concursomedellin2018.com', CHtml::normalizeUrl('http://www.concursomedellin2018.com') ); ?></p>
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