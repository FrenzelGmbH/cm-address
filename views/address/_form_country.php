<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Country $model
 * @var ActiveForm $form
 */
?>
<div class="address-_form_country">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'iso2') ?>
        <?= $form->field($model, 'iso3') ?>
        <?= $form->field($model, 'name') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('cm-address', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- address-_form_country -->
