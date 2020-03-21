<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 05.02.19
 * Time: 23:12
 */

namespace shop\forms\Shop;


use yii\base\Model;

class ReviewForm extends Model
{
    public $vote;
    public $text;

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => array_keys($this->votesList())],
            ['text', 'string'],
        ];
    }

    public function votesList(): array
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }
}