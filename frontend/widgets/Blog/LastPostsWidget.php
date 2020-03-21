<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:42
 */

namespace frontend\widgets\Blog;

use shop\fetching\Blog\PostFetchingRepository;
use yii\base\Widget;

class LastPostsWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(PostFetchingRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run(): string
    {
        return $this->render('last-posts', [
            'posts' => $this->repository->getLast($this->limit)
        ]);
    }
}