<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VbTrinh;

/**
 * VbTrinhSearch represents the model behind the search form about `backend\models\VbTrinh`.
 */
class VbTrinhSearch extends VbTrinh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nguoi_nhan'], 'integer'],
            [['so_hieu', 'noidung_vanban', 'thoigian_trinh', 'ghichu', 'created_at', 'updated_at', 'del_flg'], 'safe'],
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
        $query = VbTrinh::find();

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
            'thoigian_trinh' => $this->thoigian_trinh,
            'id_nguoi_nhan' => $this->id_nguoi_nhan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'so_hieu', $this->so_hieu])
            ->andFilterWhere(['like', 'noidung_vanban', $this->noidung_vanban])
            ->andFilterWhere(['like', 'ghichu', $this->ghichu])
            ->andFilterWhere(['like', 'del_flg', $this->del_flg]);

        return $dataProvider;
    }
}