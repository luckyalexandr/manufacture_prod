<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.01.19
 * Time: 21:37
 */

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    public $code;
    public $name;
    public $price;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification) {
            $this->code = $modification->code;
            $this->name = $modification->name;
            $this->price = $modification->price;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['code', 'name'], 'required'],
            [['price'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'code' => 'Артикул',
            'name' => 'Наименоваие',
            'price' => 'Цена',
        ];
    }
}