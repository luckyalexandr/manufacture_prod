<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.08.18
 * Time: 17:20
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Tag;
use shop\validators\SlugValidator;
use yii\base\Model;

class TagForm extends Model
{
    public $name;
    public $slug;

    private $_tag;

    public function __construct(Tag $tag = null, $config = [])
    {
        if ($tag) {
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Tag::class],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'slug' => 'Транслит',
        ];
    }
}