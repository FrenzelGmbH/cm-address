<?php
/**
 * Comment item view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 * && $model->next_type == \net\frenzel\communication\models\communication::TYPE_APPOINTMENT
 */
use yii\helpers\Url;
?>
<?php if ($model !== null) : ?>
    <div data-address="parent" data-address-id="<?= $model->id ?>">            
        <div data-address="append">            
            <div data-address="content">
            <div class="row">
                <div class="col-sm-8">
                <?php if (!is_null($model->deleted_at)) { ?>
                    <div style="color:red">
                <?php } ?>
                    <i class="fa fa-map-marker"></i> 
                    <?= $model->addresslineOne; ?>, <?= $model->zipCode; ?> <?= $model->cityName; ?>
                <?php if (!is_null($model->deleted_at)) { ?>
                    </div>
                <?php } ?>
                </div>
                <div class="col-sm-4">
                    <?php if (is_null($model->deleted_at)) { ?>
                        <div data-address="tools">
                            &nbsp;
                            <a href="#" data-address="update" data-address-id="<?= $model->id ?>" data-address-url="<?= Url::to([
                                '/address/default/update',
                                'id' => $model->id
                            ]) ?>" data-address-fetch-url="<?= Url::to([
                                '/address/default/fetch',
                                'id' => $model->id
                            ]) ?>" class="label label-default">
                                <i class="fa fa-pencil"></i> <?= \Yii::t('app', 'u') ?>
                            </a>
                            <?php if (Yii::$app->user->identity->isAdmin) { ?>
                                &nbsp;
                                <a href="#" data-address="delete" data-address-id="<?= $model->id ?>" data-address-url="<?= Url::to([
                                    '/address/default/delete',
                                    'id' => $model->id
                                ]) ?>" data-confirm="<?= \Yii::t('net_frenzel_communication', 'FRONTEND_WIDGET_COMMUNICATION_DELETE_CONFIRMATION') ?>" class="label label-danger">
                                    <i class="fa fa-remove"></i> <?= \Yii::t('app', 'd') ?>
                                </a>
                            <?php } ?>
                        </div>                
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
