<?php

namespace frenzelgmbh\cmaddress\widgets;

use Yii;

use frenzelgmbh\cmaddress\models\Address;
use frenzelgmbh\cmaddress\models\AddressSearch;

use frenzelgmbh\appcommon\widgets\Portlet;

/**
 * Related Address Grid
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Copyright (c) 2014, Frenzel GmbH
 */

class RelatedAddressGrid extends Portlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'RelatedAddressGrid';
	
	/**
	 * [$title description]
	 * @var string title that will be displayed when enabling Admin Portlet
	 */
	public $title='Related Addresses';
	
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
	protected function renderContent()
	{
		$searchModel = new AddressSearch;
    $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(),$this->module,$this->id);

    echo $this->render('@frenzelgmbh/cmaddress/widgets/views/_address_grid', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]);
	}

}