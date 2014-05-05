<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Address $model
 */

$this->title = Yii::t('cm-address', 'Update {modelClass}: ', [
  'modelClass' => 'Address',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cm-address', 'Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cm-address', 'Update');
?>
<div class="address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
