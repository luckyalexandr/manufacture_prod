<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 15:16
 */

namespace shop\entities\Shop;


use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class Brand
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'slug' => 'Транслитcc',
        ];
    }

    public function behaviors()
    {
        return [
            MetaBehavior::class,
        ];
    }
}