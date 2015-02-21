<?php
namespace frenzelgmbh\cmaddress\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cmaddress\models\WidgetConfig;

class WidgetBlogMapRender extends \yii\widgets\Block
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'MAPWIDGET';
	
	public $renderInPlace = true;

	public $module = 0;	
	public $id = 0;

	public function init() {
		\frenzelgmbh\cmaddress\sblogAsset::register(\Yii::$app->view);
		parent::init();
	}

	protected function renderContent()
	{
		$dpLocations = WidgetConfig::findRelatedModels(self::WIDGET_NAME, $this->module, $this->id);

		if(!is_null($dpLocations))
		{
			return $this->render('@frenzelgmbh/sblog/widgets/views/_mapwidget_renderer',['dpLocations'=>$dpLocations]);
		}
		else
		{
			return "";
		}
	}

}