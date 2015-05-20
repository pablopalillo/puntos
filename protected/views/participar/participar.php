<?php

Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/effects.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);

?>

<div id="content">
    <h2>Participa</h2>
    <div class="col-lg-12">
    <?php if (count($preguntas) > 0): ?>
    <p>
        Estas son las preguntas activas hasta el momento al día de hoy.
    </p>
    <?php foreach ($preguntas as $value): ?>
        <?php if ($value->estado > 0): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 style="text-align:center;"><?php echo $value->pregunta; ?></h4>
                        <p><?php echo $value->descripcion; ?></p>
                    </div>
                    <div class="col-lg-12">
                        <input type="hidden" id="id" name="id[]" value="<?php echo $value->id; ?>">
                        <?php if ($value->estado == 1): ?>
                        <button id="responder" name="responder[]" class="btn btn-success btn-lg col-xs-12">
                            Responder <span style="float:right;" class="glyphicon glyphicon-edit"></span>
                        </button>
                        <?php elseif($value->estado == 2): ?>
                        <button class="btn btn-danger btn-lg col-xs-12" disabled="disabled">
                            Responder <span style="float:right;" class="glyphicon glyphicon-check"></span>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <p>
        Hasta el momento no se encuentran preguntas para responder.
    </p>
    <?php endif; ?>
    </div>
</div>