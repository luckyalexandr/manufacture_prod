<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 09.02.19
 * Time: 11:13
 */

namespace shop\cart\storage;

use yii\web\Session;

class SessionStorage implements StorageInterface
{
    private $key;
    private $session;

    public function __construct($key, Session $session)
    {
        $this->key = $key;
        $this->session = $session;
    }

    public function load(): array
    {
        return $this->session->get($this->key, []);
    }

    public function save(array $items): void
    {
        $this->session->set($this->key, $items);
    }
}