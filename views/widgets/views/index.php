<?php
/**
 * address list view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\address\models\address[] $models address models
 * @var \net\frenzel\address\models\address $model New address model
 *
 * style="max-height:280px; overflow-y:scroll;"
 */

?>

<div id="address">

<!--/ #address-list -->
<div id="address-list" data-address="list">
    <?= $this->render('_index_item', ['models' => $models]) ?>
</div>
<!--/ #address-list -->		

<?php if (!\Yii::$app->user->isGuest) : ?>	        
    <?= $this->render('_form', ['model' => $model]); ?>
<?php endif; ?>

</div>