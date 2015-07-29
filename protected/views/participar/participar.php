<?php

Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/effects.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);

?>

<div id="content" class="ctn_participar">
    <h2>Participa</h2>
 
    <div class="ctn_preguntas">
    <?php if (count($preguntas) > 0): ?>
    
       <p>Estas son las preguntas activas hasta el momento.</p>

    <?php foreach ($preguntas as $value): ?>
        <?php if ($value->estado > 0): ?>
        <div class="ctn_pregunta">
            <div class="row-fluid">
                <div class="col-sm-9">
                    <h4 class="pregunta"><?php echo $value->pregunta; ?></h4>
                    <p class="pregunta-descripcion"><?php echo $value->descripcion; ?></p>
                </div>
                <div class="col-sm-3">
                    <input type="hidden" id="id" name="id[]" value="<?php echo $value->id; ?>">
                    <?php if ($value->estado == 1): ?>
                    <button id="responder" name="responder[]" class="btn-general_md">
                        Responder <span style="float:right;" class="glyphicon glyphicon-edit"></span>
                    </button>
                    <?php elseif($value->estado == 2): ?>
                    <button class="btn-general_md btn-disable" disabled="disabled">
                        Responder <span style="float:right;" class="glyphicon glyphicon-check"></span>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /ctn_pregunta -->
        <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <p>
        En el momento no hay datos por ingresar. Sigue pendiente de nuestra programación.
    </p>
    <?php endif; ?>
    </div>
</div>