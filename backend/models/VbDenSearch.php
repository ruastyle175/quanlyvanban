<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VbDen;

/**
 * VbDenSearch represents the model behind the search form about `backend\models\VbDen`.
 */
class VbDenSearch extends VbDen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_donvi_gui', 'id_loai_vanban', 'id_lanh_dao', 'id_can_bo', 'id_trang_thai'], 'integer'],
            [['so_hieu', 'noidung_vanban', 'thoigian_banhanh', 'thoigian_nhan', 'thoigian_hoanthanh', 'created_at', 'updated_at', 'del_flg'], 'safe'],
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
        $query = VbDen::find();

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
            'id_donvi_gui' => $this->id_donvi_gui,
            'id_loai_vanban' => $this->id_loai_vanban,
            'thoigian_banhanh' => $this->thoigian_banhanh,
            'thoigian_nhan' => $this->thoigian_nhan,
            'id_lanh_dao' => $this->id_lanh_dao,
            'id_can_bo' => $this->id_can_bo,
            'thoigian_hoanthanh' => $this->thoigian_hoanthanh,
            'id_trang_thai' => $this->id_trang_thai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'so_hieu', $this->so_hieu])
            ->andFilterWhere(['like', 'noidung_vanban', $this->noidung_vanban])
            ->andFilterWhere(['like', 'del_flg', $this->del_flg]);

        return $dataProvider;
    }
}