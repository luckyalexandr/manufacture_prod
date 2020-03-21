<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 26.01.19
 * Time: 12:20
 */

namespace shop\services\manage\Shop;


use shop\entities\Shop\Newest;
use shop\forms\manage\Shop\NewestForm;
use shop\repositories\Shop\NewestRepository;

class NewestManageService
{
    private $newests;

    public function __construct(NewestRepository $newests)
    {
        $this->newests = $newests;
    }

    public function create(NewestForm $form): Newest
    {
        $newest = Newest::create(
            $form->quantity
        );
        $this->newests->save($newest);
        return $newest;
    }

    public function edit($id, NewestForm $form): void
    {
        $newest = $this->newests->get($id);
        $newest->edit(
            $form->quantity
        );
        $this->newests->save($newest);
    }

    public function remove($id): void
    {
        $newest = $this->newests->get($id);
        $this->newests->remove($newest);
    }
}