<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AddressSearch $searchModel
 */

?>
<div class="address-grid">

<?php 
Pjax::begin();

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'zipCode',
            'cityName',
            //'postBox',
            'addresslineOne',
            'addresslineTwo',
            // 'regionName',
            // 'user_id',
            // 'mod_table',
            // 'mod_id',
            // 'system_key',
            // 'system_name',
            // 'system_upate',
            // 'created_at',
            // 'updated_at',
            // 'country_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

Pjax::end(); 
?>

</div>
