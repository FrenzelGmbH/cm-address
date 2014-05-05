<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Address $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cm-address', 'Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cm-address', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cm-address', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cm-address', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cityName',
            'zipCode',
            'postBox',
            'addresslineOne',
            'addresslineTwo',
            'regionName',
            'user_id',
            'mod_table',
            'mod_id',
            'system_key',
            'system_name',
            'system_upate',
            'created_at',
            'updated_at',
            'country_id',
        ],
    ]) ?>

</div>
