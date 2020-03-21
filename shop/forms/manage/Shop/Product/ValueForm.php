<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.12.18
 * Time: 10:27
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Value;
use yii\base\Model;

/**
 * @property integer $id
 */
class ValueForm extends Model
{
    public $value;

    private $_characteristic;

    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        if ($value) {
            $this->value = $value->value;
        }
        $this->_characteristic = $characteristic;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_characteristic->required ? ['value', 'required'] : false,
            $this->_characteristic->isString() ? ['value', 'string', 'max' => 255] : false,
            $this->_characteristic->isInteger() ? ['value', 'integer'] : false,
            $this->_characteristic->isFloat() ? ['value', 'number'] : false,
            ['value', 'safe'],
        ]);
    }

    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characteristic->name,
        ];
    }

    public function variantsList(): array
    {
        return array_diff($this->_characteristic->variants, array('', NULL, false));
    }

    public function getId(): int
    {
        return $this->_characteristic->id;
    }
}