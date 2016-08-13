<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Toko;

/**
 * TokoSearch represents the model behind the search form about `backend\models\Toko`.
 */
class TokoSearch extends Toko
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'production_id', 'profile_id', 'user_id'], 'integer'],
            [['nama_toko'], 'safe'],
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
        $query = Toko::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'production_id' => $this->production_id,
            'profile_id' => $this->profile_id,
            //'product_id' => $this->product_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nama_toko', $this->nama_toko]);

        return $dataProvider;
    }
}
