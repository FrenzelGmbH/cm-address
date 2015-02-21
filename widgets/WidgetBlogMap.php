<?php
namespace frenzelgmbh\cmaddress\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cmaddress\models\WidgetConfig;

class WidgetBlogMap extends yii\widgets\Block
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'MAPWIDGET';
	
	public $title='Map Widget';
	
	public $module = 0;	
	public $id = 0;

	public function init() {
		parent::init();
		\frenzelgmbh\cmaddress\sblogAsset::register(\Yii::$app->view);
	}

	protected function renderContent()
	{
		$query = WidgetConfig::findRelatedRecords(self::WIDGET_NAME, $this->module, $this->id);

		$dpLocations = new ActiveDataProvider(array(
		  	'query' => $query,
	  	));
		return $this->render('@frenzelgmbh/sblog/widgets/views/_mapwidget',['dpLocations'=>$dpLocations,'module'=>$this->module,'id'=>$this->id]);
	}

}