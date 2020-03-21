<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 22:01
 */

namespace shop\entities\Blog;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property int $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property Meta $meta
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, $title, $description, $sort, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->sort = $sort;
        $category->meta = $meta;
        $category->created_at = time();
        $category->updated_at = time();
        return $category;
    }

    public function edit($name, $slug, $title, $description, $sort, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->sort = $sort;
        $this->meta = $meta;
        $this->updated_at = time();
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'slug' => 'Транслит',
            'title' => 'Заголовок',
            'sort' => 'Позиция',
        ];
    }

    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
        ];
    }
}