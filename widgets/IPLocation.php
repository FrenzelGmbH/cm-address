<?php

namespace frenzelgmbh\cmaddress\widgets;

use Yii;

/**
 * Create Address Modal Button
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Copyright (c) 2014, Frenzel GmbH
 */

class IPLocation extends \yii\bootstrap\Widget
{
  /**
   * const WIDGET_NAME must be defined for all widgets!
   */
  const WIDGET_NAME = 'IPLocation';
  
  /**
   * [$title description]
   * @var string title that will be displayed when enabling Admin Portlet
   */
  public $title='Show Location';

  /**
   * define the options for the rendering of the map widget
   * @var [type]
   */
  public $options=[
    'height' => '400',
    'zoom'   => '10'
  ];
  
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
    $result = \frenzelgmbh\cmaddress\models\Address::getIPLocation();

    if($result->getLatitude() == 0)
    {
      echo $this->render('@frenzelgmbh/cmaddress/widgets/views/_iplocation',[
        'latitude'      => 48.8077,
        'longitude'     => 9.15362,
        'options'       => $this->options
      ]);
    }
    else
    {
      echo $this->render('@frenzelgmbh/cmaddress/widgets/views/_iplocation',[
        'latitude'      => $result->getLatitude(),
        'longitude'     => $result->getLongitude(),
        'options'       => $this->options
      ]);
    } 
  }

}
