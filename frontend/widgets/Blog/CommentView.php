<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:41
 */

namespace frontend\widgets\Blog;

use shop\entities\Blog\Post\Comment;

class CommentView
{
    public $comment;
    /**
     * @var self[]
     */
    public $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}