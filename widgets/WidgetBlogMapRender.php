<?php
namespace frenzelgmbh\cm-address\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cm-address\models\WidgetConfig;
use frenzelgmbh\appcommon\widgets\Portlet;

class WidgetBlogMapRender extends Portlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'MAPWIDGET';
	
	public $module = 0;	
	public $id = 0;

	public function init() {
		parent::init();
		\frenzelgmbh\cm-address\sblogAsset::register(\Yii::$app->view);
	}

	protected function renderContent()
	{
		$dpLocations = WidgetConfig::findRelatedModels(self::WIDGET_NAME, $this->module, $this->id);

	  if(!is_null($dpLocations))
	  {
			//here we don't return the view, here we just echo it!
			echo $this->render('@frenzelgmbh/sblog/widgets/views/_mapwidget_renderer',['dpLocations'=>$dpLocations]);
		}
		else
		{
			echo "";
		}
	}

}