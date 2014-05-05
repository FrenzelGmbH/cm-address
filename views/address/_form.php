<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Address $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'mod_id')->textInput() ?>

    <?= $form->field($model, 'system_upate')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'cityName')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'addresslineOne')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'addresslineTwo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mod_table')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'system_key')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'system_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'zipCode')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'postBox')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'regionName')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('cm-address', 'Create') : Yii::t('cm-address', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
