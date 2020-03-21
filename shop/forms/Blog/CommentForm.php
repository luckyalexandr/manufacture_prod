<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 9:49
 */

namespace shop\forms\Blog;

use yii\base\Model;

class CommentForm extends Model
{
    public $parentId;
    public $text;

    public function rules(): array
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['parentId', 'integer'],
        ];
    }
}