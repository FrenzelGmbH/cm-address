<?php

namespace net\frenzel\address\controllers\api;

/**
* This is the class for REST controller "CountryController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class CountryController extends \yii\rest\ActiveController
{
public $modelClass = 'net\frenzel\address\models\Country';
}
