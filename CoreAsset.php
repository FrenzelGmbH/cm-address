<?php
namespace net\frenzel\address;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

use yii\web\AssetBundle;

/**
 * Module asset bundle.
 */
class CoreAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@net/frenzel/address/assets';
    
    /**
     * @inheritdoc
     */
    public $css = [
        'css/frenzel_address.css'
    ];
    
    /**
     * @inheritdoc
     */
    public $js = [
        'js/frenzel_address.js'
    ];
    
    /**
     * @inheritdoc
     */
    public $depends = [
    	'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];
}
