<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 0:30
 */

namespace shop\fetching\Shop;

//use Elasticsearch\Client;
use shop\entities\Shop\Category;
use shop\fetching\Shop\views\CategoryView;
use yii\helpers\ArrayHelper;

class CategoryFetchingRepository
{
//    private $client;
//
//    public function __construct(Client $client)
//    {
//        $this->client = $client;
//    }

    public function getRoot(): Category
    {
        return Category::find()->roots()->one();
    }

    /**
     * @return Category[]
     */
    public function getAll(): array
    {
        return Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->all();
    }

    public function find($id): ?Category
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeWithSubsOf(Category $category = null): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');

        if ($category) {
            $criteria = ['or', ['depth' => 1]];
            foreach (ArrayHelper::merge([$category], $category->parents) as $item) {
                $criteria[] = ['and', ['>', 'lft', $item->lft], ['<', 'rgt', $item->rgt], ['depth' => $item->depth + 1]];
            }
            $query->andWhere($criteria);
        } else {
            $query->andWhere(['depth' => 1]);
        }

//        $aggs = $this->client->search([
//            'index' => 'shop',
//            'type' => 'products',
//            'body' => [
//                'size' => 0,
//                'aggs' => [
//                    'group_by_category' => [
//                        'terms' => [
//                            'field' => 'categories',
//                        ]
//                    ]
//                ],
//            ],
//        ]);
//
//        $counts = ArrayHelper::map($aggs['aggregations']['group_by_category']['buckets'], 'key', 'doc_count');

        return array_map(function (Category $category) {
            return new CategoryView($category, ArrayHelper::getValue($category->id, 0));
        }, $query->all());
    }



    public static function getTree($categories, $left = 0, $right = null, $depth = 1)
    {
        $tree = [];

        foreach ($categories as $index => $category) {
            if ($category->depth >= $left + 1 && (is_null($right) || $category->rgt <= $right) && $category->depth == $depth) {
                $tree[$index] = [
                    'id' => $category->id,
                    'label' => $category->name,
                    'url' => ['/shop/catalog/category', 'id' => $category->id],
                    'items' => self::getTree($categories, $category->lft, $category->rgt, $category->depth + 1),
                ];
            }
        }

        return $tree;

    }

    public static function getFullTreeStructure()
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');

        $roots = Category::find()->roots()->addOrderBy('lft')->all();
        $tree = [];
        foreach ($roots as $root){
            $tree [] = [
                'id' => $root->id,
                'label' => $root->name,
                'url' => ['/shop/catalog/category', 'id' => $root->id],
                'items' => self::getTree($root->children),
            ];
        }

        return array_map(function (Category $root) {
            return new CategoryView($root, ArrayHelper::getValue($root->id, 0));
        }, $query->all());
    }

    public static function getMenuTreeStructure()
    {
        $query = Category::find()->roots()->addOrderBy('lft')->all();

        $roots = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->all();
        $tree = [];
        foreach ($roots as $root){
            $tree [] = [
                'id' => $root->id,
                'label' => $root->name,
                'url' => ['/shop/catalog/category', 'id' => $root->id],
                'items' => self::getTree($root->children),
            ];
        }

        return $tree;
    }
}