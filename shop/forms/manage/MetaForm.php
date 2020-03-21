<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 16:08
 */

namespace shop\forms\manage;

use shop\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $description;
    public $keywords;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title = $meta->title;
            $this->description = $meta->description;
            $this->keywords = $meta->keywords;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
//            [['title', 'description', 'keywords'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
        ];
    }
}