<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 25.01.19
 * Time: 13:18
 */

namespace shop\entities\Shop;


use yii\db\ActiveRecord;

/**
 * Class Newest
 * @package shop\entities\Shop
 *
 * @property integer $quantity
 */
class Newest extends ActiveRecord
{
    public static function create($quantity): self
    {
        $newest = new Newest();
        $newest->quantity = $quantity;
        return $newest;
    }

    public function edit($quantity): void
    {
        $this->quantity = $quantity;
    }

    public static function tableName()
    {
        return '{{%shop_novetly}}';
    }

    public function attributeLabels(): array
    {
        return [
            'quantity' => 'Количество новинок',
        ];
    }
}