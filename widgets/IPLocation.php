<?php

namespace frenzelgmbh\cmaddress\widgets;

use Yii;
use frenzelgmbh\appcommon\widgets\AdminPortlet;

/**
 * Create Address Modal Button
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Copyright (c) 2014, Frenzel GmbH
 */

class IPLocation extends AdminPortlet
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
    $buzz    = new \Buzz\Browser(new \Buzz\Client\Curl());
    $adapter = new \Geocoder\HttpAdapter\BuzzHttpAdapter($buzz);
    
    $geocoder = new \Geocoder\Geocoder();
    $geocoder->registerProviders([
      new \Geocoder\Provider\FreeGeoIpProvider($adapter)
    ]);

    if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $client_ip = $_SERVER['REMOTE_ADDR'];
    }
    else {
      $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    $result = $geocoder->geocode($client_ip);

    echo $this->render('@frenzelgmbh/cmaddress/widgets/views/_iplocation',[
      'latitude'      => $result->getLatitude(),
      'longitude'     => $result->getLongitude()
    ]);
  }

}
