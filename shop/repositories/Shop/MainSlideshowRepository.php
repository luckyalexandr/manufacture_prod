<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 10:02
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\MainSlideshow;
use shop\repositories\NotFoundException;

class MainSlideshowRepository
{
    public function get($id): MainSlideshow
    {
        if (!$slideshow = MainSlideshow::findOne($id)) {
            throw new NotFoundException('Brand is not found.');
        }
        return $slideshow;
    }

    public function save(MainSlideshow $slideshow): void
    {
        if (!$slideshow->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(MainSlideshow $slideshow): void
    {
        if (!$slideshow->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}