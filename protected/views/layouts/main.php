<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="telemedellin.tv">

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/libs/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
	<link rel="icon" href="/images/favicon.ico" />
	<!--[if LTE IE 8]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.95570.js"></script>
	<![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<header>
	<div class="container-fluid">
		<div id="logo"><?php echo CHtml::link( CHtml::image(Yii::app()->request->baseUrl . '/images/logo.png', 'Viaja a Suiza con Medellín 2018', array('width' => 232, 'height' => 226)), CHtml::normalizeUrl('/') ); ?></div>
		<div id="mainmenu">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'¿Cómo participar?', 'url'=>array('/como-jugar'), 'linkOptions' => array('class' => 'item1')),
					array('label'=>'Estos eran los premios', 'url'=>array('/premio'), 'linkOptions' => array('class' => 'item1')),
					array('label'=>'Puntajes más altos', 'url'=>array('/puntajes'), 'linkOptions' => array('class' => 'item1')),
				),
			)); ?>
		</div>
		<div id="share">
			<ul>
				<li><div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-action="recommend"></div></li>
				<li><a href="https://twitter.com/share" class="twitter-share-button" data-text="Estoy concursando por un viaje a Suiza con @Medellin2018yog ¡y tú también puedes participar!" data-hashtags="Medellín2018" data-dnt="true">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
			</ul>
		</div>
		<div id="usermenu">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Ingresa a tu perfil', 'url'=>array('/iniciar-sesion'), 'linkOptions' => array('class' => 'perfil'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Registro', 'url'=>array('/registro'), 'linkOptions' => array('class' => 'perfil'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Perfil', 'url'=>array('/perfil'), 'linkOptions' => array('class' => 'perfil'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Salir', 'url'=>array('/cerrar-sesion'), 'linkOptions' => array('class' => 'sesion'), 'visible'=>!Yii::app()->user->isGuest),
				),
			)); ?>
		</div>
	</div>
</header>
<div class="container">

	<?php echo $content; ?>

</div>
<footer>
	<div class="container-fluid">
		<ul>
			<li><a class="tm" href="http://www.telemedellin.tv" target="_blank">Telemedellín</a></li>
			<li><a class="ol" href="http://www.medellin2018.org" target="_blank">Olímpicos</a></li>
			<li><a class="mv" href="http://www.noviolenciamedellin.co/" target="_blank">Mayo por la vida</a></li>
			<li><a class="al" href="http://www.medellin.gov.co" target="_blank">Alcaldía</a></li>
		</ul>
			<?php echo CHtml::link( 'Términos y condiciones', array('/terminos-y-condiciones'), array('class' => 'terminos' ) ); ?> <span>contacto@concursomedellin2018.com</span>
	</div>
</footer>
<div id="fb-root"></div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->getBaseUrl().'/css/libs/bootstrap/js/bootstrap.min.js' , CClientScript::POS_END);?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->getBaseUrl().'/js/script.js' , CClientScript::POS_END);?>

<script>
/*concurso */
/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=266957946747620";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/</script>
<script>
  /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-41062091-1', 'concursomedellin2018.com');
  ga('send', 'pageview');
*/
</script>
</body>
</html>
