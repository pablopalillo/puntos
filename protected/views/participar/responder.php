<?php

Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/effects.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><?php echo $pregunta; ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php foreach ($respuestas as $key => $value): ?>
                <div class="col-lg-6">
                    <input type="hidden" id="id" name="id[]" value="<?php echo $value->id; ?>" >
                    <button id="respuesta" name="respuesta[]" class="btn btn-primary btn-lg col-xs-12"><?php echo $value->respuesta; ?></button>
                </div>
                <?php if($key == 1): ?>
                </div>
                <br>
                <div class="row">
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<button id="goBack" class="btn btn-success btn-lg">
    <span class="glyphicon glyphicon-arrow-left"></span> Volver atras
</button>