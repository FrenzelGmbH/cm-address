<?php
namespace net\frenzel\address\views\widgets;

/**
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

use Yii;
use yii\base\InvalidConfigException;
use net\frenzel\address\models\Address;

/**
 * class MapWidget
 * @package net\frenzel\address
 */
class MapWidget extends \yii\bootstrap\Widget
{
	/**
     * @var \yii\db\ActiveRecord|null Widget model
     */
    public $model;

     /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->model === null) {
            throw new InvalidConfigException('The "model" property must be set.');
        }
    }

	public function run()
	{
		$class = $this->model;
        $class = $class::className();
        $models = Address::getAddresses($this->model->id, $class);
        $model = new Address(['scenario' => 'create']);
        $model->entity = $class;
        $model->entity_id = $this->model->id;
        return $this->render('_mapwidget', [
            'dpLocations' => $models,
            'model' => $model
        ]);		
	}

}