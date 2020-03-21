<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.03.19
 * Time: 16:24
 */

namespace backend\forms\Shop;

use shop\entities\Shop\Product\Review;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReviewSearch extends Model
{
    public $id;
    public $text;
    public $vote;
    public $active;
    public $product_id;

    public function rules(): array
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['text'], 'safe'],
            [['vote'], 'in', 'range' => [1, 2, 3, 4, 5]],
            ['active', 'boolean'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Review::find()->with(['product']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => function (Review $review) {
                return [
                    'product_id' => $review->product_id,
                    'vote' => $review->vote,
                    'id' => $review->id,
                ];
            },
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'vote' => $this->vote,
        ]);

        $query
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    public function activeList(): array
    {
        return [
            1 => Yii::$app->formatter->asBoolean(true),
            0 => Yii::$app->formatter->asBoolean(false),
        ];
    }
}