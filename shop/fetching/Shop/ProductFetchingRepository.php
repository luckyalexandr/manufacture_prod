<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 30.01.19
 * Time: 15:13
 */

namespace shop\fetching\Shop;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Product\Value;
use shop\entities\Shop\Tag;
use shop\forms\Shop\Search\SearchForm;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class ProductFetchingRepository
{
    public function count(): int
    {
        return Product::find()->where('main_photo_id >= 1')->andWhere(['status' => 1])->active()->count();
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return Product::find()->where('main_photo_id >= 1')->alias('p')->active('p')->andWhere(['status' => 1])->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function getAll(): DataProviderInterface
    {
        $query = Product::find()->where('main_photo_id >= 1')->andWhere(['status' => 1])->alias('p')->active('p')->with('mainPhoto');
        return $this->getProvider($query);
    }

    public function getSale(): DataProviderInterface
    {
        $query = Product::find()->where('main_photo_id >= 1')->andWhere('price_old >= 1')->andWhere(['status' => 1])->alias('p')->active('p')->with('mainPhoto');
        return $this->getProvider($query);
    }

    public function getNewestP(): DataProviderInterface
    {
        $query = Product::find()->alias('p')->where('main_photo_id >= 1')->limit(24)->with('mainPhoto')->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC]);

        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Product::find()->where('main_photo_id >= 1')->alias('p')->active('p')->with('mainPhoto', 'category')->andWhere(['status' => 1]);
        $ids = ArrayHelper::merge([$category->id], $category->getLeaves()->select('id')->column());
        $query->joinWith(['categoryAssignments ca'], false);
        $query->andWhere(['or', ['p.category_id' => $ids], ['ca.category_id' => $ids]]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getAllByBrand(Brand $brand): DataProviderInterface
    {
        $query = Product::find()->where('main_photo_id >= 1')->alias('p')->active('p')->with('mainPhoto')->where('main_photo_id >= 1')->andWhere(['status' => 1]);
        $query->andWhere(['p.brand_id' => $brand->id]);
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with('mainPhoto')->andWhere(['status' => 1])->where('main_photo_id >= 1');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getFeatured($limit): array
    {
        return Product::find()->where('main_photo_id >= 1')->with('mainPhoto')->andWhere(['status' => 1])->orderBy(['rating' => SORT_DESC])->limit($limit)->all();
    }

    public function getNewest($limit): array
    {
        return Product::find()->where('main_photo_id >= 1')->with('mainPhoto')->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function getMainSale($limit): array
    {
        return Product::find()->where('main_photo_id >= 1')->with('mainPhoto')->andWhere(['status' => 1])->andWhere('price_old >= 1')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function find($id)
    {
        return Product::find()->active()->andWhere(['id' => $id])->one();
    }

    public function findBySlug($slug)
    {
        return Product::find()->andWhere(['slug' => $slug])->andWhere(['status' => 1])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                    'rating' => [
                        'asc' => ['p.rating' => SORT_ASC],
                        'desc' => ['p.rating' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }

    public function search(SearchForm $form): DataProviderInterface
    {
        $query = Product::find()->alias('p')->where('main_photo_id >= 1')->active('p')->with(['mainPhoto', 'category', 'brand']);

        if ($form->brand) {
            if ($brand = Brand::findOne($form->brand))
            $query->andWhere(['p.brand_id' => $form->brand]);
        }

        if ($form->category) {
            if ($category = Category::findOne($form->category)) {
                $ids = ArrayHelper::merge([$form->category], $category->getChildren()->select('id')->column());
                $query->joinWith(['categoryAssignments ca'], false);
                $query->andWhere(['or', ['p.category_id' => $ids], ['ca.category_id' => $ids]]);
            } else {
                $query->andWhere(['p.id' => 0]);
            }
        }

        if ($form->values) {
            $productIds = null;
            foreach ($form->values as $value) {
                if ($value->isFilled()) {
                    $q = Value::find()->andWhere(['characteristic_id' => $value->getId()]);

                    $q->andFilterWhere(['>=', 'CAST(value AS SIGNED)', $value->from]);
                    $q->andFilterWhere(['<=', 'CAST(value AS SIGNED)', $value->to]);
                    $q->andFilterWhere(['value' => $value->equal]);

                    $foundIds = $q->select('product_id')->column();
                    $productIds = $productIds === null ? $foundIds : array_intersect($productIds, $foundIds);
                }
            }

            if ($productIds !== null) {
                $query->andWhere(['p.id' => $productIds]);
            }
        }

        if (!empty($form->text)) {
            $query->andWhere(['or',
                ['like', 'name', $form->text],
                ['like', 'code', $form->text],
            ]);
        }

        $query->groupBy('p.id');

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                ],
            ]
        ]);
    }

    public function getWishList($userId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Product::find()
                ->alias('p')->active('p')
                ->joinWith('wishlistItems w', false, 'INNER JOIN')
                ->andWhere(['w.user_id' => $userId]),
            'sort' => false,
        ]);
    }

    public function getRecommended($quantity)
    {
        return array_rand(Product::find()->where(['status' => 1])->all(), $quantity);
    }
}