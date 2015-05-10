<?php

namespace frenzelgmbh\cmaddress\widgets;

use Yii;

/**
 * Create Address Modal Button
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Copyright (c) 2014, Frenzel GmbH
 */

class CreateAddressModal extends \yii\bootstrap\Widget
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'CreateAddressModal';
	
	/**
	 * [$title description]
	 * @var string title that will be displayed when enabling Admin Portlet
	 */
	public $title='Create Address';
	
	/**
	 * [$module description]
	 * @var string the module, mostly we recommend to take the table name in which records will be stored
	 */
	public $module = NULL;

	/**
	 * [$id description]
	 * @var integer id that is the primarey key value of the reference value
	 */
	public $id = NULL;

	/**
	 * [init description]
	 * @return bool the result of the parent init call
	 */
	public function init() {		
		\frenzelgmbh\cmaddress\addressAsset::register(\Yii::$app->view);
		return parent::init();
	}

	/**
	 * [renderContent description]
	 * @return [type] [description]
	 */
	public function run()
	{
		return $this->render('@frenzelgmbh/cmaddress/widgets/views/_create_modal',[
			'module' => $this->module,
			'id'		 => $this->id
		]);
	}

}