<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span3 last">
		<div id="sidebar">
			<?php 
				if(!Yii::app()->user->isGuest) 
					if($this->id == 'jugador')
					{
						$this->widget('JugadorMenu', 
							array('usuario_id' => Yii::app()->user->id)
	    				);
	    			}
			?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>