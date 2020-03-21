<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.12.18
 * Time: 9:47
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @property array $newNames
 */
class TagsForm extends Model
{
    public $existing = [];
    public $textNew;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->existing = ArrayHelper::getColumn($product->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'existing' => 'Имеющиеся',
            'textNew' => 'Написать новые',
        ];
    }

    public function tagsList(): array
    {
        return ArrayHelper::map(Tag::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function getNewNames(): array
    {
        return array_map('trim', preg_split('#\s*,\s*#i', $this->textNew, -1, PREG_SPLIT_NO_EMPTY));
    }

    public function beforeValidate(): bool
    {
        $this->existing = array_filter((array)$this->existing);
        return parent::beforeValidate();
    }
}