<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.12.18
 * Time: 12:47
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Characteristic;
use shop\helpers\CharacteristicHelper;
use yii\base\Model;

/**
 * Class CharacteristicForm
 * @package shop\forms\manage\Shop
 *
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            $this->name = $characteristic->name;
            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'type' => 'Тип',
            'sort' => 'Сортировка',
            'required' => 'Обязательно',
            'textVariants' => 'Варианты',
            'default' => 'По умолчанию',
        ];
    }

    public function typesList(): array
    {
        return CharacteristicHelper::typeList();
    }

    public function getVariants(): array
    {
        return preg_split('#\s+#i', $this->textVariants);
    }
}