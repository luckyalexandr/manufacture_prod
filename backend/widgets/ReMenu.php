<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 3:33
 */

namespace backend\widgets;

use dmstr\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ReMenu extends Menu
{
    public static $iconClassPrefix = '';
    /**
     * @inheritdoc
     */
//    protected function renderItem($item)
//    {
//        if (isset($item['items'])) {
//            $labelTemplate = '<a href="{url}">{icon} {label} <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
//            $linkTemplate = '<a href="{url}">{icon} {label} <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
//        } else {
//            $labelTemplate = $this->labelTemplate;
//            $linkTemplate = $this->linkTemplate;
//        }
//
//        $replacements = [
//            '{label}' => strtr($this->labelTemplate, ['{label}' => $item['label'],]),
//            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml : $item['icon'],
//            '{url}' => isset($item['url']) ? Url::to($item['url']) : 'javascript:void(0);',
//        ];
//
//        $template = ArrayHelper::getValue($item, 'template', isset($item['url']) ? $linkTemplate : $labelTemplate);
//
//        return strtr($template, $replacements);
//    }
}