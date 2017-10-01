<?php
/**
 * Comment widget form view.
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \net\frenzel\comment\models\frontend\Comment $model New comment model
 */
use yii\helpers\Html;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
?>

<div class="panel">
    <div class="panel-body">

<?php $form = ActiveForm::begin([
        'action' => ['/address/default/update','id' => $model->id],
        'method' => 'POST', 
        'type'   => ActiveForm::TYPE_INLINE,
        'formConfig' => ['showErrors' => true],
        'options' => [
            'data-address' => 'form', 
            'data-address-action' => 'update',
            'data-address-id' => $model->id,
        ]
    ]
) ?>
        
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'type')->radioButtonGroup($model->TypeArray,[
                    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-warning']]
                ]);?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'isMain')->radioButtonGroup([0=>"NOT MAIN", 1=>"MAIN"],[
                    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-info']]
                ]);?>
            </div>
        </div>

        <?= $form->field($model, 'addresslineOne')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'regionName')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'addresslineTwo')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'postBox')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'zipCode')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'cityName')->input('text',['class'=>'input-sm']); ?>     

        <?= Html::submitButton('<i class="fa fa-plus"></i> ' . \Yii::t('net_frenzel_address', 'upd.'), 
            ['class' => 'btn btn-success btn-sm pull-right']
        ); ?>     

<div class="clear-fix"></div>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?php ActiveForm::end(); ?>

    </div>
</div>
