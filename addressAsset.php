<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace frenzelgmbh\cmaddress;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class addressAsset extends AssetBundle
{
    public $sourcePath = '@frenzelgmbh/cmaddress/assets';
    
    public $css = [
        'css/cm-address.css'
    ];
    
    public $js = [];
    
    public $depends = [];
}
