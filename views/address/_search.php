<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\AddressSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cityName') ?>

    <?= $form->field($model, 'zipCode') ?>

    <?= $form->field($model, 'postBox') ?>

    <?= $form->field($model, 'addresslineOne') ?>

    <?php // echo $form->field($model, 'addresslineTwo') ?>

    <?php // echo $form->field($model, 'regionName') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'mod_table') ?>

    <?php // echo $form->field($model, 'mod_id') ?>

    <?php // echo $form->field($model, 'system_key') ?>

    <?php // echo $form->field($model, 'system_name') ?>

    <?php // echo $form->field($model, 'system_upate') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cm-address', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cm-address', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
