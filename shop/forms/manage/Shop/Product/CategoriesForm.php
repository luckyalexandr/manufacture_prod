<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.12.18
 * Time: 10:08
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoriesForm extends Model
{
    public $main;
    public $others = [];

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->main = $product->category_id;
            $this->others = ArrayHelper::getColumn($product->categoryAssignments, 'category_id');
        }
        parent::__construct($config);
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function rules(): array
    {
        return [
            ['main', 'required'],
            ['main', 'integer'],
            ['others', 'each', 'rule' => ['integer']],
            ['others', 'default', 'value' => []],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'main' => 'Основная',
            'others' => 'Вспомогательные',
        ];
    }

    public function beforeValidate(): bool
    {
        $this->others = array_filter((array)$this->others);
        return parent::beforeValidate();
    }
}