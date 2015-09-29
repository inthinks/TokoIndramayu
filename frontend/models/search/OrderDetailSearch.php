<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\OrderDetail;

/**
 * OrderDetailSearch represents the model behind the search form about `frontend\models\OrderDetail`.
 */
class OrderDetailSearch extends OrderDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'product_id', 'toko_id', 'quantity'], 'integer'],
            [['order_code', 'email'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OrderDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'toko_id' => $this->toko_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'order_code', $this->order_code])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
