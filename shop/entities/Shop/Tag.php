<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.08.18
 * Time: 17:12
 */

namespace shop\entities\Shop;


use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * Class Tag
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    public static function create($name, $slug): self
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->slug = Inflector::slug($slug);
        return $tag;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = Inflector::slug($slug);
    }

    public static function tableName()
    {
        return '{{%shop_tags}}';
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'slug' => 'Транслит',
        ];
    }
}