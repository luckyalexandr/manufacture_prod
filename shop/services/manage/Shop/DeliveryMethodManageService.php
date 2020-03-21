<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 1:58
 */

namespace shop\services\manage\Shop;

use shop\entities\Shop\DeliveryMethod;
use shop\forms\manage\Shop\DeliveryMethodForm;
use shop\repositories\Shop\DeliveryMethodRepository;
class DeliveryMethodManageService
{
    private $methods;

    public function __construct(DeliveryMethodRepository $methods)
    {
        $this->methods = $methods;
    }

    public function create(DeliveryMethodForm $form): DeliveryMethod
    {
        $method = DeliveryMethod::create(
            $form->name,
            $form->cost,
            $form->sort
        );
        $this->methods->save($method);
        return $method;
    }

    public function edit($id, DeliveryMethodForm $form): void
    {
        $method = $this->methods->get($id);
        $method->edit(
            $form->name,
            $form->cost,
            $form->sort
        );
        $this->methods->save($method);
    }

    public function remove($id): void
    {
        $method = $this->methods->get($id);
        $this->methods->remove($method);
    }
}