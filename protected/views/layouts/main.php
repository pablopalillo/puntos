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
	<link href='http://fonts.googleapis.com/css?family=Economica:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
	<link rel="icon" href="/images/favicon.ico" />
	<!--[if LTE IE 8]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.95570.js"></script>
	<![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container">
	<header>
		<div class="row">
			<div class="col-sm-7 col-md-7">
				<div id="logo"><?php echo CHtml::link( CHtml::image(Yii::app()->getBaseUrl() . '/images/logo.png', 'Puntos TM'), Yii::app()->getBaseUrl(true) ); ?></div>
			</div>
			<div class="col-sm-5 col-md-5">
				<div class="row">
					<div class="ctn-btnParticipar col-sm-12 col-xs-6">
						<a href="<?php echo Yii::app()->getBaseUrl(true).'/participar' ?>" class="btnParticipar">Juega Aquí</a>
					</div>
					<div class="ctn_mainmenu col-sm-12 col-xs-6">
						<div id="mainmenu">
							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(
                  array('label'=>'Perfil', 'url'=>array('/perfil'), 'linkOptions' => array('class' => 'perfil'), 'visible'=>!Yii::app()->user->isGuest),
									array('label'=>'Mecánica', 'url'=>array('/como-jugar'), 'linkOptions' => array('class' => 'item1')),
									array('label'=>'Premios', 'url'=>array('/premio'), 'linkOptions' => array('class' => 'item1')),
									array('label'=>'Ranking', 'url'=>array('/ranking'), 'linkOptions' => array('class' => 'item1')),
								),
							)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="ctn_main">
        <div id="content-page">
            <?php echo $content; ?>
        </div>
        <div id="progress"></div>
        <div class="clear"></div>
	</div>
	<footer class="container-fluid ctn_footer">
		<div  class="row">
			<a class="tm" href="http://www.telemedellin.tv" target="_blank">Telemedellín</a>
			<a class="alc" href="https://www.medellin.gov.co/" target="_blank">Telemedellín</a>
			<?php echo CHtml::link( 'Términos y condiciones', array('/terminos-y-condiciones'), array('class' => 'terminos' ) ); ?> <span>Puntos Telemedellín</span>
		</div>
	</footer>
</div>
<div id="fb-root"></div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->getBaseUrl().'/css/libs/bootstrap/js/bootstrap.min.js' , CClientScript::POS_END);?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->getBaseUrl().'/js/script.js' , CClientScript::POS_END);?>

<script>
/* */
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

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-5650687-24', 'auto');
  ga('send', 'pageview');


</script>

</body>
</html>
