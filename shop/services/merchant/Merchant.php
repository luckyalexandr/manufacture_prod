<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 14.10.2019
 * Time: 00:41
 */

namespace shop\services\merchant;

use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Response;

class Merchant extends Model
{
    public function renderFeed(): string
    {
        $products = Product::find()->all();
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->startElement('rss');
        $writer->writeAttribute('version', '2.0');
        $writer->writeAttribute('xmlns:g', 'http://base.google.com/ns/1.0');

        $writer->startElement('channel');
        $writer->writeElement('title', 'Manufacture17');
        $writer->writeElement('link', 'https://manufacture17.com.ua');
        $writer->writeElement('description', 'Интернет-магазин тканей');

        foreach ($products as $product) {
            $writer->startElement('item');
            $writer->writeElement('g:id', $product->code);
            $writer->writeElement('g:price', $product->price_new . ' UAH');
            $writer->writeElement('g:condition', 'new');
            $writer->writeElement('g:availability', 'in_stock');
            $writer->writeElement('g:product_type', 'Каталог > ' .  $product->category->name);
            $writer->writeElement('g:image_link', Html::encode(Url::to([$product->mainPhoto->getThumbFileUrl('file', 'large')], true)));
            $writer->writeElement('link', Html::encode(Url::to(['slug-product', 'slug' => $product->slug], true)));
            $writer->writeElement('g:url', Html::encode(Url::to(['slug-product', 'slug' => $product->slug], true)));
            $writer->writeElement('title', $product->name);
            $writer->writeElement('description', $product->description);
            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();

        return $writer->flush();
    }
}