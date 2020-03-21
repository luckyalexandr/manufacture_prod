<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 3:45
 */

namespace backend\forms\Shop;


use shop\entities\Shop\Newest;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NewestSearch extends Model
{
    public $id;
    public $quantity;

    public function rules(): array
    {
        return [
            [['id', 'quantity'], 'integer'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Newest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' =>$this->quantity,
        ]);

        return $dataProvider;
    }
}