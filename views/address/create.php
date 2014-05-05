<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Address $model
 */

$this->title = Yii::t('cm-address', 'Create {modelClass}', [
  'modelClass' => 'Address',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cm-address', 'Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
