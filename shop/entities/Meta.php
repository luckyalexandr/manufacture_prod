<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 15:07
 */

namespace shop\entities;


class Meta
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}