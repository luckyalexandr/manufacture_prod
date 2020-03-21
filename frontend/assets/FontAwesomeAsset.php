<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 24.01.19
 * Time: 14:27
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/all.css',
    ];
}