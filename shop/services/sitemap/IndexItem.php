<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.03.19
 * Time: 0:37
 */

namespace shop\services\sitemap;

class IndexItem
{
    public $location;
    public $lastModified;

    public function __construct($location, $lastModified = null)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
    }
}