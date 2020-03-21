<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 5:19
 */

namespace backend\forms\Shop;


use shop\entities\Shop\MainSlideshow;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MainSlideshowSearch extends Model
{
    public $id;
    public $title;
    public $link;
    public $sort;

    public function rules(): array
    {
        return [
            [['id', 'sort'], 'integer'],
            [['title', 'link'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = MainSlideshow::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}