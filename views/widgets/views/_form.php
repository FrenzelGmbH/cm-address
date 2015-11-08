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

/**
 * @property string $cityName
 * @property string $zipCode
 * @property string $postBox
 * @property string $addresslineOne
 * @property string $addresslineTwo
 * @property float $longitude
 * @property float $latitude
 * @property string $regionName
 *
 * @property Country $country
 */


/**
 * this js script allows people to press ctrl+s to save values
 * @var [type]
 */
$script = <<<SKRIPT

$('#net-address-create-s').click(function() {
    $('#container_net_frenzel_address_form').show( 1000 );
});

$('#net-address-create-c').click(function() {
    $('#container_net_frenzel_address_form').hide( 1000 );
});

SKRIPT;

$this->registerJs($script);

?>

<div id="net-address-create-s"><small>+ <?= \Yii::t('net_frenzel_address','new address'); ?></small></div>

<div id="container_net_frenzel_address_form" style="display:none">

<div class="panel">
    <div class="panel-body">
        
<?php $form = ActiveForm::begin([
        'action' => ['/address/default/create'], 
        'method' => 'POST', 
        'type'   => ActiveForm::TYPE_INLINE,
        'formConfig' => ['showErrors' => true],
        'options' => [
            'data-address' => 'form', 
            'data-address-action' => 'create'
        ]
    ]
) ?>
        <?= $form->field($model, 'type')->radioButtonGroup($model->TypeArray,[
                'itemOptions' => ['labelOptions' => ['class' => 'btn btn-warning']]
        ]);?>

        <?= $form->field($model, 'isMain')->radioButtonGroup([0=>"NOT MAIN", 1=>"MAIN"],[
                'itemOptions' => ['labelOptions' => ['class' => 'btn btn-info']]
        ]);?>

        <?= $form->field($model, 'addresslineOne')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'regionName')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'addresslineTwo')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'postBox')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'zipCode')->input('text',['class'=>'input-sm']); ?>
        
        <?= $form->field($model, 'cityName')->input('text',['class'=>'input-sm']); ?>     

        <?= Html::submitButton('<i class="fa fa-plus"></i> ' . \Yii::t('net_frenzel_address', 'add'), 
            ['class' => 'btn btn-success btn-sm pull-right']
        ); ?>     


<div class="clearfix"></div>

<div id="net-address-create-c" class="pull-right"><small>x <?= \Yii::t('net_frenzel_address','close'); ?></small></div>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?php ActiveForm::end(); ?>

    </div>
</div>

</div>