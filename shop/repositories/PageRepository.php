<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:09
 */

namespace shop\repositories;

use shop\entities\Page;

class PageRepository
{
    public function get($id): Page
    {
        if (!$page = Page::findOne($id)) {
            throw new NotFoundException('Page is not found.');
        }
        return $page;
    }

    public function save(Page $page): void
    {
        if (!$page->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Page $page): void
    {
        if (!$page->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}