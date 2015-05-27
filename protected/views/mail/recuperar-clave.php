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
				<img src="<?php echo Yii::app()->getBaseUrl(true).'/images/mail/header-mail.jpg' ?>" width="605" height="154" style="width: 100%; height: auto;" />
			</td>
		</tr>
		<tr>
			<td>
				<center>
				<table style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="500">
					<p>Has pedido recuperar tu contraseña, por favor sigue el siguiente enlace para hacerlo: </p>
					<p><?php echo CHtml::link(Yii::app()->getBaseUrl(true).'/validar-identidad/' . $token, CHtml::normalizeUrl(Yii::app()->getBaseUrl(true).'/validar-identidad/' . $token ) ); ?></p>
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
