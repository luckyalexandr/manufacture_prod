<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 25.01.19
 * Time: 23:50
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Newest;
use yii\base\Model;

class NewestForm extends Model
{
    public $quantity;

    private $_nowetly;

    public function __construct(Newest $newest = null, $config = [])
    {
        if ($newest) {
            $this->quantity = $newest->quantity;
            $this->_nowetly = $newest;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['quantity'], 'required'],
            [['quantity'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'quantity' => 'Количество отображаемых новинок',
        ];
    }
}