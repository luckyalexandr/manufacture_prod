<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 21:59
 */

namespace shop\entities\Blog;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'slug' => 'Транслит'
        ];
    }

    public static function tableName(): string
    {
        return '{{%blog_tags}}';
    }
}