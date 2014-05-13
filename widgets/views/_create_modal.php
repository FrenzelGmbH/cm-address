<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

?>

<?php 
  
Modal::begin([
  'id'=>'caddressmod',
  'header' => '<i class="fa fa-info"></i>Loading',
]);
echo 'pls. wait one moment...';
Modal::end();

$modalJS = <<<MODALJS

openaddressmod = function(){
    var th=$(this), id=th.attr('id').slice(0);  
    $('#caddressmod').modal('show');
    $('#caddressmod div.modal-header').html('Add Address');
    $('#caddressmod div.modal-body').load(th.attr('href'));
    return false;
};

$('#mod_address_add').on('click',openaddressmod);

MODALJS;

  $this->registerJs($modalJS);

?>

<?= Html::a(\Yii::t('app','Create'), [
    '/address/default/create',
    'module' => $module, 
    'id' => $id,
  ], 
  [
    'class' => 'btn btn-info navbar-btn',
    'id' => 'mod_address_add'
  ]
);?>
