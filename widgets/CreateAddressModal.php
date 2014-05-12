<?php
namespace frenzelgmbh\cmaddress\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\appcommon\widgets\Portlet;

class CreateAddressModal extends Portlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'CreateAddressModal';
	
	public $title='Create Address';
	
	public $module = NULL;	
	public $id = NULL;

	public function init() {
		parent::init();
		\frenzelgmbh\cmaddress\addressAsset::register(\Yii::$app->view);
	}

	protected function renderContent()
	{
		echo $this->render('@frenzelgmbh/cmaddress/widgets/views/_create_modal',[
			'module'=>$this->module,
			'id'=>$this->id
		]);
	}

}