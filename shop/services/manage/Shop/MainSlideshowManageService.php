<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 10:04
 */

namespace shop\services\manage\Shop;


use shop\entities\Shop\MainSlideshow;
use shop\forms\manage\Shop\MainSlideshowForm;
use shop\repositories\Shop\MainSlideshowRepository;

class MainSlideshowManageService
{
    private $slides;

    public function __construct(MainSlideshowRepository $slides)
    {
        $this->slides = $slides;
    }

    public function create(MainSlideshowForm $form): MainSlideshow
    {
        $slideShow = MainSlideshow::create(
            $form->title,
            $form->text,
            $form->link,
            $form->sort,
            $form->image
        );
        $this->slides->save($slideShow);

        return $slideShow;
    }

    public function edit(int $id, MainSlideshowForm $form): void
    {
        $slide = $this->slides->get($id);
        $slide->edit(
            $form->title,
            $form->text,
            $form->link,
            $form->sort,
            $form->image
        );
        $this->slides->save($slide);
    }

    public function remove($id): void
    {
        $slide = $this->slides->get($id);
        $this->slides->remove($slide);
    }
}