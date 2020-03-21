<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.02.19
 * Time: 21:28
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class MagnificPopupAsset extends AssetBundle
{
    public $sourcePath = '@bower/magnific-popup/dist';
    public $css = [
        'magnific-popup.css',
    ];
    public $js = [
        'jquery.magnific-popup.js',
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}