<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.01.19
 * Time: 0:39
 */

namespace shop\entities\Shop\Product;

use shop\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;


/**
 * Class Photo
 * @package shop\entities\Shop\Product
 *
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_photos}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@webroot/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl' => '@web/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath' => '@webroot/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@web/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'small' => ['width' => 100, 'height' => 70],
                    'large' => ['width' => 300, 'height' => 300],
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'cart_list' => ['width' => 150, 'height' => 150],
                    'cart_widget_list' => ['width' => 57, 'height' => 57],
                    'catalog_list' => ['width' => 228, 'height' => 228],
                    'catalog_product_main' => ['processor' => [new WaterMarker(1000, 750, '@frontend/web/uploads/logo/logo.png'), 'process']],
                    'catalog_product_additional' => ['width' => 66, 'height' => 66],
                    'catalog_origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/uploads/logo/logo.png'), 'process']],
                ],
            ],
        ];
    }
}