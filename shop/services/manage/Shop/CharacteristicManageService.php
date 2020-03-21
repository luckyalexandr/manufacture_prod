<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.01.19
 * Time: 16:12
 */

namespace shop\services\manage\Shop;


use shop\entities\Shop\Characteristic;
use shop\forms\manage\Shop\CharacteristicForm;
use shop\repositories\Shop\CharacteristicRepository;

class CharacteristicManageService
{
    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form): void
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}