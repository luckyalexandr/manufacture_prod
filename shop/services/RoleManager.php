<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 23.02.19
 * Time: 17:54
 */

namespace shop\services;

use yii\rbac\ManagerInterface;

class RoleManager
{
    private $manager;

    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $userId
     * @param $name
     * @throws \Exception
     */
    public function assign($userId, $name): void
    {
        if (!$role = $this->manager->getRole($name)) {
            throw new \DomainException('Роль "' . $name . '" не существует.');
        }
        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);
    }
}