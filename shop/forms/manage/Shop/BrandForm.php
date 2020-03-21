<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 15:52
 */

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Brand;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;

/**
 * Class BrandForm
 * @package shop\forms\manage\Shop
 * @property MetaForm $meta
 */
class BrandForm extends CompositeForm
{
    public $name;
    public $slug;

    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name = $brand->name;
            $this->slug = $brand->slug;
            $this->meta = new MetaForm($brand->meta);
            $this->_brand = $brand;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'slug' => 'Транслит',
        ];
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}