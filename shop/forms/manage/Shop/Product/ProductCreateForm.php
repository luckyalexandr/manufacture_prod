<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.12.18
 * Time: 12:55
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Brand;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * Class ProductCreateForm
 * @package shop\forms\manage\Shop\Product
 * @property PriceForm $price
 * @property QuantityForm $quantity
 * @property LongitudeForm $longitude
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $slug;
    public $description;

    public function __construct($config = [])
    {
        $this->price = new PriceForm();
        $this->quantity = new QuantityForm();
        $this->longitude = new LongitudeForm();
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->tags = new TagsForm();
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name'], 'required'],
            [['code', 'name', 'slug'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
            ['slug', SlugValidator::class],
            [['code', 'slug'], 'unique', 'targetClass' => Product::class],
            ['description', 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'brandId' => 'Бренд',
            'code' => 'Артикул',
            'name' => 'Наименование',
            'slug' => 'URL',
            'description' => 'Описание',
        ];
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['price', 'quantity', 'longitude', 'meta', 'photos', 'categories', 'tags', 'values'];
    }
}