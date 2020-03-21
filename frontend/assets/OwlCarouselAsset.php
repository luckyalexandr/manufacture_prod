<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 24.01.19
 * Time: 14:38
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = '@bower/owl.carousel/dist';
    public $css = [
        'assets/owl.carousel.css',
    ];
    public $js = [
        'owl.carousel.js',
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
