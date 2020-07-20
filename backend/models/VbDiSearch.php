<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VbDi;

/**
 * VbDiSearch represents the model behind the search form about `backend\models\VbDi`.
 */
class VbDiSearch extends VbDi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nhom_vanban', 'id_loai_vanban', 'id_nguoiki'], 'integer'],
            [['so_hieu', 'noidung_vanban', 'thoigian_banhanh', 'noi_nhan', 'file_dinhkem', 'created_at', 'updated_at', 'del_flg'], 'safe'],
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
        $query = VbDi::find();

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
            'id_nhom_vanban' => $this->id_nhom_vanban,
            'id_loai_vanban' => $this->id_loai_vanban,
            'thoigian_banhanh' => $this->thoigian_banhanh,
            'id_nguoiki' => $this->id_nguoiki,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'so_hieu', $this->so_hieu])
            ->andFilterWhere(['like', 'noidung_vanban', $this->noidung_vanban])
            ->andFilterWhere(['like', 'noi_nhan', $this->noi_nhan])
            ->andFilterWhere(['like', 'file_dinhkem', $this->file_dinhkem])
            ->andFilterWhere(['like', 'del_flg', $this->del_flg]);

        return $dataProvider;
    }
}