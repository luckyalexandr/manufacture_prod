<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:07
 */

namespace shop\fetching;

use shop\entities\Page;

class PageFetchingRepository
{
    public function find($id): ?Page
    {
        return Page::findOne($id);
    }

    public function getAll(): array
    {
        return Page::find()->andWhere(['>', 'depth', 0])->all();
    }

    public function findBySlug($slug): ?Page
    {
        return Page::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }
}