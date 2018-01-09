<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var net\frenzel\address\models\Country $model
*/

$this->title = Yii::t('models', 'Country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud country-create">

    <h1>
        <?= Yii::t('models', 'Country') ?>
        <small>
                        <?= $model->name ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
