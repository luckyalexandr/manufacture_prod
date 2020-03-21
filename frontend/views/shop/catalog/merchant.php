<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.10.2019
 * Time: 10:30
 */

use yii\helpers\Html;
use yii\helpers\Url;

//<?xml version="1.0" encoding="UTF-8"
//xml-stylesheet type="text/css" href="/css/doc.css"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
<channel>
    <title>Manufacture17</title>
    <description>Интернет-магазин тканей</description>
    <link>https://manufacture17.com.ua</link>

    <?php foreach ($products as $product): ?>
    <item>
        <link><?= Html::encode(Url::to(['slug-product', 'slug' => $product->slug])) ?></link>
        <g:id><?= $product->code ?></g:id>
        <g:price><?= $product->price_new ?> UAH</g:price>
        <g:condition>new</g:condition>
        <g:availability>in_stock</g:availability>
        <g:product_type><?= $product->category->name ?>></g:product_type>
        <g:image_link><?= $product->mainPhoto->getThumbFileUrl('file', 'large') ?></g:image_link>
        <title><?= $product->name ?></title>
        <description><?= $product->description ?></description>
    </item>
    <?php endforeach; ?>
</channel>
</rss>